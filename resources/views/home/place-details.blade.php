@extends('layouts.frontend.master')
@section('title')
    {{ trans('titles.placeDetails') }}
@endsection

@section('css')
    <!-- إضافة مكتبة A-Frame -->
    <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
    <!-- إضافة مكونات إضافية -->
    <script src="https://unpkg.com/aframe-event-set-component@3.0.3/dist/aframe-event-set-component.min.js"></script>

@endsection

@section('content')
    <div class="container place-details-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="place-card">
                    <div class="place-header">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <strong>{{ trans('titles.placeDetails') }}</strong>
                    </div>

                    <div class="place-image-container">
                        <!-- زر التبديل بين العرض العادي والواقع الافتراضي -->
                        <button class="view-mode-toggle" onclick="toggleViewMode()">
                           <i class="fas fa-image mr-2"></i> {{ __('buttons.switch_to_normal') }}
                        </button>

                        <!-- صورة عادية -->
                        <img id="normal-image" class="place-image d-none" src="{{ asset('storage/place/' . $place->image) }}"
                            alt="{{ $place->name }}" style="height: 500px;">

                        <!-- عرض الواقع الافتراضي -->
                        <div id="vr-view" class="vr-view-container">
                            <a-scene embedded>

                                <a-assets>
                                    <img id="panorama" src="{{ asset('storage/place/' . $place->image) }}"
                                        alt="{{ $place->name }}">
                                    crossorigin="anonymous">
                                </a-assets>

                                <!-- إضافة إضاءة محيطية -->
                                <a-light type="ambient" color="#ffffff" intensity="0.8"></a-light>

                                <!-- إضافة سماء مع تأثير دوران -->
                                <a-sky src="#panorama" rotation="0 -90 0"
                                    animation="property: rotation; to: 0 270 0; loop: true; dur: 120000; easing: linear"></a-sky>

                                <!-- إضافة عناصر تحكم متقدمة للكاميرا -->
                                <a-camera position="0 1.6 0"></a-camera>
                            </a-scene>
                        </div>
                    </div>

                    <div class="place-details">
                        <h1 class="place-title">{{ $place->name }}</h1>

                        <div class="place-meta">
                            <div class="place-meta-item">
                                <i class="fas fa-user"></i>
                                <span>{{ $place->addedBy }}</span>
                            </div>
                            <div class="place-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $place->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="place-meta-item">
                                <i class="fas fa-map"></i>
                                <span>{{ $place->district->name }}</span>
                            </div>
                            <div class="place-meta-item">
                                <i class="fas fa-tag"></i>
                                <span>{{ $place->placetype->name }}</span>
                            </div>
                        </div>

                        <div class="place-description">
                            {!! $place->description !!}
                        </div>
                    </div>

                    <div class="card-footer text-center py-4">
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">
                            {{-- {!! icon('back') !!} --}}
                            {!! trans('buttons.back') !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- إضافة مكتبة A-Frame -->

    <script>
        AFRAME.registerComponent('info-message', {
            schema: {
                message: { type: 'string', default: 'معلومات المكان' }
            },
            init: function () {
                let el = this.el;
                let data = this.data;

                el.addEventListener('mouseenter', function () {
                    // إظهار رسالة عند التحويم
                    let messageEl = document.createElement('a-text');
                    messageEl.setAttribute('value', data.message);
                    messageEl.setAttribute('position', '1 0 0');
                    messageEl.setAttribute('scale', '2 2 2');
                    messageEl.setAttribute('color', '#ffffff');
                    el.appendChild(messageEl);
                });

                el.addEventListener('mouseleave', function () {
                    // إخفاء الرسالة عند مغادرة التحويم
                    let messageEl = el.querySelector('a-text');
                    if (messageEl) {
                        el.removeChild(messageEl);
                    }
                });
            }
        });

        function toggleViewMode() {
            const normalImage = document.getElementById('normal-image');
            const vrView = document.getElementById('vr-view');
            const toggleButton = document.querySelector('.view-mode-toggle');
            $(normalImage).toggleClass('d-none');
            $(vrView).toggleClass('d-none');

            if ($(vrView).hasClass('d-none')) {
                toggleButton.innerHTML = '<i class="fas fa-vr-cardboard mr-2"></i> {{ __('buttons.switch_to_virtual') }}';
            } else {
                toggleButton.innerHTML = '<i class="fas fa-image mr-2"></i> {{ __('buttons.switch_to_normal') }}';
            }
        }
    </script>
@endpush