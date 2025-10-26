<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'max_seats' => 'nullable|numeric|integer',
            // 'package_image' => 'required|mimes:jpeg,png,jpg',
            'description' => 'nullable',
            'places' => 'required|array|min:1',
        ];
    }
}
