@php
    use Illuminate\Support\Facades\Auth;
@endphp

<header class="navbar-expand-md">
    <div class="navbar-collapse collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    @if (Auth::user()->role !== "system_admin")
                        <li class="nav-item {{ Route::currentRouteName() == 'rates-index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('rates-index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-star-filled" style="width: 24px; height: 24px;"></i>
                                </span>
                                <span class="nav-link-title">{{ __('rates.title') }}</span>
                            </a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() == 'licenses' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('licenses') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-shield-filled" style="width: 24px; height: 24px;"></i>
                                </span>
                                <span class="nav-link-title">{{ __('license.title') }}</span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role === "system_admin")
                        <li class="nav-item {{ Route::currentRouteName() == 'rates-index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('rates-index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="align-middle" data-feather="star"></i>
                                </span>
                                <span class="nav-link-title">Школы</span>
                            </a>
                        </li>
                    @endif


                </ul>
                <div class="navbar-nav flex-row order-md-last">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <div class="d-none d-xl-block ps-2">
                                <div>{{Auth::user()->school->name}}</div>
                                <div class="mt-1 small text-secondary">{{Auth::user()->school->bin}}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <form action="{{ route('logout-action') }}" method="POST" id="logout-form" style="display: none;">
                                @csrf
                            </form>
                            <a href="{{ route('change.language',  app()->getLocale() == 'ru' ? 'kk' : 'ru') }}" class="dropdown-item">
                                {{ app()->getLocale() == 'ru' ? __('kk') : __('ru') }}
                            </a>
                            <a href="#" class="dropdown-item" onclick="document.getElementById('logout-form').submit();">{{__("logout")}}</a>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
