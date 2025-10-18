@extends('layouts.frontend.master')
@section('title')
    {{ trans('titles.placeDetails') }}
@endsection

@section('css')
<!-- إضافة مكتبة A-Frame -->
<script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
<!-- إضافة مكونات إضافية -->
<script src="https://unpkg.com/aframe-event-set-component@3.0.3/dist/aframe-event-set-component.min.js"></script>
<style>
    .place-details-container {
        margin-top: 100px;
        margin-bottom: 50px;
    }
    
    .place-card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
    }
    
    .place-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 20px;
        font-size: 1.5rem;
    }
    
    .place-image-container {
        position: relative;
        overflow: hidden;
    }
    
    .place-image {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }
    
    .place-image:hover {
        transform: scale(1.05);
    }
    
    .vr-view-container {
        height: 500px;
        width: 100%;
        margin-bottom: 20px;
    }
    
    .view-mode-toggle {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 100;
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .view-mode-toggle:hover {
        background: rgba(0,0,0,0.8);
    }
    
    .place-info {
        padding: 30px;
    }
    
    .place-title {
        font-size: 2.2rem;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .place-meta {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .place-meta-item {
        display: inline-flex;
        align-items: center;
        margin-right: 20px;
    }
    
    .place-meta-item i {
        margin-right: 5px;
        color: #3498db;
    }
    
    .place-description {
        color: #34495e;
        line-height: 1.8;
        font-size: 1.1rem;
        text-align: justify;
    }
    
    .back-button {
        background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    
    .back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        color: white;
    }
</style>
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
                    {{-- <button class="view-mode-toggle" onclick="toggleViewMode()">
                        <i class="fas fa-vr-cardboard mr-2"></i> تبديل إلى الواقع الافتراضي
                    </button> --}}
                    
                    <!-- صورة عادية -->
                    {{-- <img id="normal-image" class="place-image" src="{{ asset('storage/place/'.$place->image) }}" alt="{{ $place->name }}"> --}}
                    
                    <!-- عرض الواقع الافتراضي -->
                    <div id="vr-view" class="vr-view-container">
                        <a-scene embedded>
                            <a-assets>
                                <img id="panorama" src="{{ asset('storage/place/'.$place->image) }}" crossorigin="anonymous">
                            </a-assets>
                            
                            <!-- إضافة إضاءة محيطية -->
                            <a-light type="ambient" color="#ffffff" intensity="0.8"></a-light>
                            
                            <!-- إضافة سماء مع تأثير دوران -->
                            <a-sky src="#panorama" rotation="0 -90 0" animation="property: rotation; to: 0 270 0; loop: true; dur: 120000; easing: linear"></a-sky>
                            
                            <!-- إضافة نقاط معلومات تفاعلية -->
                            {{-- <a-entity position="0 1.6 -4">
                                <a-sphere color="#ff4444" radius="0.2" animation="property: scale; to: 1.2 1.2 1.2; dir: alternate; dur: 1000; loop: true">
                                    <a-text value="{{ $place->name }}" position="1 0 0" scale="2 2 2" color="#ffffff" align="center"></a-text>
                                </a-sphere>
                            </a-entity>
                             --}}
                            <!-- إضافة عناصر تحكم متقدمة للكاميرا -->
                            <!-- {{-- <a-camera position="0 1.6 0"
                                      look-controls="reverseMouseDrag: false"
                                      wasd-controls="enabled: true; acceleration: 100"
                                      cursor="rayOrigin: mouse"
                                      raycaster="far: 5000; objects: .clickable">
                                <a-entity position="0 0 -1"
                                      geometry="primitive: ring; radiusInner: 0.01; radiusOuter: 0.02"
                                      material="color: white; shader: flat"
                                      cursor="maxDistance: 30; fuse: true">
                                    <a-animation begin="click" easing="ease-in" attribute="scale"
                                             dur="150" fill="forwards" from="0.1 0.1 0.1" to="1 1 1"></a-animation>
                                    <a-animation begin="fusing" easing="ease-in" attribute="scale"
                                             dur="1500" fill="backwards" from="1 1 1" to="0.1 0.1 0.1"></a-animation>
                                </a-entity>
                            </a-camera>
                             --}} -->
                             <!-- إضافة عناصر تزيينية -->
                            <a-entity position="-3 1 -4">
                                <a-box color="#4CC3D9" depth="0.5" height="0.5" width="0.5"
                                       animation="property: rotation; to: 0 360 0; loop: true; dur: 10000; easing: linear"
                                       class="clickable"
                                       event-set__mouseenter="material.opacity: 0.8"
                                       event-set__mouseleave="material.opacity: 1"></a-box>
                            </a-entity> 
                        </a-scene>
                    </div>
                </div>
                
                <div class="place-info">
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
                    <a href="{{ URL::previous() }}" class="back-button">
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
            message: {type: 'string', default: 'معلومات المكان'}
        },
        init: function() {
            let el = this.el;
            let data = this.data;
            
            el.addEventListener('mouseenter', function() {
                // إظهار رسالة عند التحويم
                let messageEl = document.createElement('a-text');
                messageEl.setAttribute('value', data.message);
                messageEl.setAttribute('position', '1 0 0');
                messageEl.setAttribute('scale', '2 2 2');
                messageEl.setAttribute('color', '#ffffff');
                el.appendChild(messageEl);
            });
            
            el.addEventListener('mouseleave', function() {
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
        
        if (normalImage.style.display !== 'none') {
            normalImage.style.display = 'none';
            vrView.style.display = 'block';
            toggleButton.innerHTML = '<i class="fas fa-image mr-2"></i> تبديل إلى الصورة العادية';
        } else {
            normalImage.style.display = 'block';
            vrView.style.display = 'none';
            toggleButton.innerHTML = '<i class="fas fa-vr-cardboard mr-2"></i> تبديل إلى الواقع الافتراضي';
        }
    }
</script>
@endpush
      
