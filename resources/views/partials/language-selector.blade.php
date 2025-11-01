<div class="dropdown language-selector">
    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-globe me-1"></i>
        @if(session('locale') == 'ar')
            العربية
        @else
            English
        @endif
    </button>
    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
        <li>
            <a class="dropdown-item {{ session('locale') == 'ar' ? 'active' : '' }}" href="{{ route('profile.switch-language', ['locale' => 'ar']) }}">
                <i class="fas fa-language me-1"></i> العربية
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ session('locale') == 'en' ? 'active' : '' }}" href="{{ route('profile.switch-language', ['locale' => 'en']) }}">
                <i class="fas fa-language me-1"></i> English
            </a>
        </li>
    </ul>
</div>