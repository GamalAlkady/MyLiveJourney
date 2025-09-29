@extends('layouts.backend.master')

@section('title')
    {{ __('messages.tours') }}
@endsection

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <!-- عنوان الصفحة وأزرار الإجراءات -->
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-gradient text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                    <i class="fas fa-map-marked-alt fs-4"></i>
                                </div>
                                <h2 class="mb-0">{{ __('messages.all_tours') }}</h2>
                            </div>
                            <div>
                                <a href="{{ route('admin.tour.create') }}"
                                    class="btn btn-light btn-md px-4 py-2 rounded hover-effect">
                                    <i class="fas fa-plus-circle text-success me-2"></i>
                                    {{ __('messages.add_new_tour') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- عرض الجولات -->
                <div class="row">
                    @forelse ($tours as $tour)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow hover-card">
                                <!-- صورة الجولة -->
                                <div class="card-img-top overflow-hidden">
                                    <img src="{{ asset('storage/tourImage/' . $tour->image) }}" alt="{{ $tour->name }}"
                                        style="height: 220px; width: 100%; object-fit: cover;"
                                        class="img-fluid w-100 h-200px object-fit-cover"
                                        onerror="this.onerror=null; this.src='{{ asset('assets/admin/img/default-150x150.png') }}';">
                                </div>

                                <!-- تفاصيل الجولة -->
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title text-primary">{{ $tour->name }}</h4>
                                    <div class="row mt-3 ">
                                        <div class="col-12 row mb-2">
                                            {{-- <i class="fas fa-money-bill-wave text-success me-2"></i> --}}
                                            <span class="fw-bold col-md-4">{!! __('forms.price') !!}:</span>
                                            <span class="col-md-8 ms-auto text-primary fw-bold">{{ $tour->price }}
                                                {{ __('messages.currency') }}</span>
                                        </div>

                                        <div class="col-12 row mb-2">
                                            <span class="col-4 fw-bold">{!! __('forms.people') !!}:</span>
                                            <span class="col-8 ms-auto text-info fw-bold">{{ $tour->people }}</span>
                                        </div>

                                        <div class="col-12 row mb-2">
                                            <span class="col-4 fw-bold">{!! __('forms.date') !!}:</span>
                                            <span class="col-8 ms-auto text-info fw-bold">{{ $tour->date }} -
                                                {{ Carbon\Carbon::parse($tour->date)->addDays($tour->day - 1)->format('Y-m-d') }}</span>
                                        </div>

                                        <div class="col-12 row mb-2">
                                            <span class="col-4 fw-bold">{!! __('forms.days') !!}:</span>
                                            <span class="col-8 ms-auto text-info fw-bold">{{ $tour->day }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- أزرار الإجراءات -->
                                <div class="card-footer bg-white border-top">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('admin.tour.show', $tour->id) }}"
                                            class="btn btn-info btn-sm px-3">
                                            {!! __('buttons.details') !!}
                                        </a>
                                        {!! Form::open([
                                            'url' => route('admin.tour.destroy', $tour->id),
                                            'class' => 'd-inline-block',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'Delete',
                                        ]) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button(trans('buttons.delete2'), [
                                            'class' => 'btn btn-danger btn-sm d-inline-block',
                                            'type' => 'button',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#confirmDelete',
                                            'data-title' => 'Delete Place Type',
                                            'data-message' => 'Are you sure you want to delete this place type ?',
                                        ]) !!}
                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle fa-3x mb-3"></i>
                                <h3 class="mt-3">{{ __('messages.no_data_found') }}</h3>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة الحوار لحذف الحزمة -->
    <div class="modal fade" id="deletePackageModal" tabindex="-1" aria-labelledby="deletePackageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" id="deletePackageForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deletePackageModalLabel">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ __('messages.package_remove') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fas fa-question-circle fa-3x text-danger mb-3"></i>
                            <p>{{ __('messages.confirm_delete_package') }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-arrow-left me-2"></i>
                            {{ __('messages.no_go_back') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-2"></i>
                            {{ __('messages.yes_delete') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('scripts')
    @if (count($tours) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users')
    @endif


    <script>
        function handleDeletePackage(id) {
            var form = document.getElementById('deletePackageForm');
            form.action = 'package/' + id;
            const modal = new bootstrap.Modal(document.getElementById('deletePackageModal'));
            modal.show();
        }
    </script>
@endsection
