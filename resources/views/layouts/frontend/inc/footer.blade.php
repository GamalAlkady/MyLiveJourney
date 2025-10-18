@section('css')
<style>
  .social-icon{
    margin-inline-start: 10px;
  }
</style>
@endsection
<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
      <div class="row g-4">
        <!-- قسم أنواع الأماكن -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-section">
            <h3 class="footer-title mb-4 text-uppercase">
               {!! __('titles.models.placetypes') !!}
            </h3>
            <div class="footer-links">
              {{-- <!-- @php
                $placetypes = App\Models\Placetype::all();
              @endphp --> --}}
              @forelse ($placetypes as $placetype)
                <div class="footer-link mb-2">
                  <a href="{{ route('placetype.wise.place', $placetype->id) }}" class="d-flex align-items-center">
                    <i class="fas fa-chevron-left me-2 text-primary"></i>
                    <span>{{ $placetype->name }}</span>
                  </a>
                </div>
              @empty
                <div class="alert alert-secondary mb-0 text-center">
                  <i class="fas fa-info-circle me-2"></i>
                  {{ __('alerts.no_available_placestypes') }}
                </div>
              @endforelse
            </div>
          </div>
        </div>

        <!-- قسم الخدمات -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-section">
            <h3 class="footer-title mb-4 text-uppercase">
              <i class="fas fa-concierge-bell me-2"></i>{{ __('titles.our_services') }}
            </h3>
            <div class="footer-links">
              <div class="footer-link mb-2">
                <a href="#" class="d-flex align-items-center">
                  <i class="fas fa-shield-alt me-2 text-success"></i>
                  <span>{{ __('titles.footer.safe_reliable') }}</span>
                </a>
              </div>
              <div class="footer-link mb-2">
                <a href="#" class="d-flex align-items-center">
                  <i class="fas fa-tag me-2 text-info"></i>
                  <span>{{ __('titles.footer.low-cost') }}</span>
                </a>
              </div>
              <div class="footer-link mb-2">
                <a href="#" class="d-flex align-items-center">
                  <i class="fas fa-star me-2 text-warning"></i>
                  <span>{{ trans_choice('titles.amazing_places',0) }}</span>
                </a>
              </div>
              <div class="footer-link mb-2">
                <a href="#" class="d-flex align-items-center">
                  <i class="fas fa-lock me-2 text-danger"></i>
                  <span>{{ __('titles.footer.secure') }}</span>
                </a>
              </div>
              <div class="footer-link mb-2">
                <a href="#" class="d-flex align-items-center">
                  <i class="fas fa-user-tie me-2 text-primary"></i>
                  <span>{{ __('titles.footer.talented_guides') }}</span>
                </a>
              </div>
              <div class="footer-link mb-0">
                <a href="#" class="d-flex align-items-center">
                  <i class="fas fa-headset me-2 text-secondary"></i>
                  <span>{{ __('titles.footer.suppor') }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- قسم الموقع والاتصال -->
        <div class="col-lg-4 col-md-12">
          <div class="footer-section">
            <h3 class="footer-title mb-4 text-uppercase">
              <i class="fas fa-map-marker-alt me-2"></i>{{ __('titles.footer.contact_us') }}
            </h3>
            <div class="contact-info">
              <div class="contact-item mb-3">
                <div class="d-flex align-items-start">
                  <div class="icon-box me-3">
                    <i class="fas fa-map-marker-alt"></i>
                  </div>
                  <div>
                    <h6 class="mb-1">{{ __('forms.labels.address') }}</h6>
                    <p class="mb-0 text-white-50 ms-2">Riyadh</p>
                  </div>
                </div>
              </div>
              <div class="contact-item mb-3">
                <div class="d-flex align-items-start">
                  <div class="icon-box me-3">
                   {!! icon('phone','phone-icon') !!}
                  </div>
                  <div>
                    <h6 class="mb-1">{{ __('forms.labels.phone') }}</h6>
                    <p class="mb-0 text-white-50 ms-2">+88 0189562356</p>
                  </div>
                </div>
              </div>
              <div class="contact-item mb-4">
                <div class="d-flex align-items-start">
                  <div class="icon-box me-3">
                    {!! icon('email','email-icon') !!}
                  </div>
                  <div>
                    <h6 class="mb-1">{{ __('forms.labels.email') }}</h6>
                    <p class="mb-0 text-white-50 ms-2">tourist-guide@gmail.com</p>
                  </div>
                </div>
              </div>
              <div class="social-links">
                <h6 class="mb-3">{{ __('titles.follow_us') }}</h6>
                <div class="d-flex gap-3">
                  <a href="#" class="social-icon">{!! icon('facebook','facebook-icon') !!}</a>
                  <a href="#" class="social-icon">{!! icon('twitter','twitter-icon') !!}</a>
                  <a href="#" class="social-icon">{!! icon('instagram','instagram-icon') !!}</a>
                  <a href="#" class="social-icon">{!! icon('linkedin','linkedin-icon') !!}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-4 bg-secondary opacity-25">

      <div class="row align-items-center">
        <div class="col-md-6">
          <p class="mb-0 text-white-50">جميع الحقوق محفوظة &copy; {{ date('Y') }} <b>Tourist Guide</b></p>
        </div>
        <div class="col-md-6 text-md-end">
          <nav class="footer-nav">
            <a href="#" class="me-3">سياسة الخصوصية</a>
            <a href="#">الشروط والأحكام</a>
          </nav>
        </div>
      </div>
    </div>
  </footer>