<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Facades\Image;

class UsersManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('search');
        $type = $request->get('type');

        if ($type == 'guide')
            $users = User::whereGuides();
        elseif ($type == 'user')
            $users = User::whereUuserssers();
        else
            $users = User::withoutAdmin();

        if ($searchTerm) {
            $users = $users->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
        }
        $users = $users->paginate(config('settings.paginateListSize'));

        return View('pages.usersmanagement.show-users', compact('users'));
    }

    public function guideList()
    {
        $guides = User::whereRoleIs('admin')->paginate(15);
        return view('pages.users.guideList', compact('guides'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('slug', '!=', 'admin')->get();

        return view('pages.usersmanagement.create-user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|max:255|unique:users|alpha_dash',
                'first_name'            => 'alpha_dash',
                'last_name'             => 'alpha_dash',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
            ],
            [
                'name.unique'         => trans('auth.userNameTaken'),
                'name.required'       => trans('auth.userNameRequired'),
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Get Form Image
        $image = $request->file('image');


        if (isset($image)) {


            // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


            // Check Category Dir is exists

            if (!Storage::disk('public')->exists('guide')) {
                Storage::disk('public')->makeDirectory('guide');
            }


            // Resize Image for category and upload
            $GuideImage = Image::make($image)->resize(180, 210)->stream();
            Storage::disk('public')->put('guide/' . $imageName, $GuideImage);
        } else {
            $imageName = null;
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();

        $user = User::create([
            'name'             => strip_tags($request->input('name')),
            'first_name'       => strip_tags($request->input('first_name')),
            'last_name'        => strip_tags($request->input('last_name')),
            'image'            => $imageName,
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);

        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save();

        return redirect(route('user.users.index'))->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->notify(new SendGoodbyeEmail($user));
        return view('pages.usersmanagement.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::withoutAdmin()->get();

        // foreach ($user->roles as $userRole) {
            // $currentRole = $roles[1];
            $currentRole = auth()->user()->roles()->first();
        // }

        // if($user->isUser())
        // dd($currentRole);
        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
        ];

        return view('pages.usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $emailCheck = ($request->input('email') !== '') && ($request->input('email') !== $user->email);
        $ipAddress = new CaptureIpTrait();

        if ($emailCheck) {
            $validator = Validator::make($request->all(), [
                'name'          => 'required|max:255|unique:users|alpha_dash',
                'email'         => 'email|max:255|unique:users',
                'first_name'    => 'alpha_dash',
                'last_name'     => 'alpha_dash',
                'password'      => 'present|confirmed|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name'          => 'required|max:255|alpha_dash|unique:users,name,' . $user->id,
                'first_name'    => 'alpha_dash',
                'last_name'     => 'alpha_dash',
                'password'      => 'nullable|confirmed|min:6',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = strip_tags($request->input('name'));
        $user->first_name = strip_tags($request->input('first_name'));
        $user->last_name = strip_tags($request->input('last_name'));

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        $userRole = $request->input('role');
        if ($userRole !== null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->updated_ip_address = $ipAddress->getClientIp();

        switch ($userRole) {
            case 3:
                $user->activated = 0;
                break;

            default:
                $user->activated = 1;
                break;
        }

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        $ipAddress = new CaptureIpTrait();

        if ($user->id !== $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->delete();

            return redirect()->route('user.users.index')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm . '%')
            ->orWhere('name', 'like', $searchTerm . '%')
            ->orWhere('email', 'like', $searchTerm . '%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }

    public function activeUser(Request $request, User $user)
    {
        $user->activated = 1;
        $message = trans('usersmanagement.activeSuccess');
        if ($request->has('deactivate')) {
            $user->activated = 0;
            $message = trans('usersmanagement.inactiveSuccess');
        }
        $user->save();
        return back()->with('success', $message);
    }

    public function inactiveUser(User $user)
    {
        $user->activated = 0;
        $user->save();
        return back()->with('success', trans('usersmanagement.inactiveSuccess'));
    }
}
