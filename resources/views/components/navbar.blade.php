@php use Illuminate\Support\Facades\Auth; @endphp

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="/">
            <span class="align-middle">{{ __("title") }}</span>

        </a>

        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">
            @if(Auth::user()->role !== "system_admin")
                <li class="sidebar-item {{ Route::currentRouteName() == 'rates-index' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('rates-index') }}">
                        <i class="align-middle" data-feather="star"></i> <span class="align-middle">{{__('rates.title')}}</span>
                    </a>
                </li>


                <li class="sidebar-item {{ Route::currentRouteName() == 'licenses' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('licenses') }}">
                        <i class="align-middle" data-feather="shield"></i> <span class="align-middle">{{__('license.title')}}</span>
                    </a>
                </li>

            @elseif(Auth::user()->role === "system_admin")
                <li class="sidebar-item {{ Route::currentRouteName() == 'rates-index' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('rates-index') }}">
                        <i class="align-middle" data-feather="star"></i> <span class="align-middle">Школы</span>
                    </a>
                </li>

            @endif
        </ul>


        <div class="sidebar-footer mt-4 p-3 rounded-3 shadow-lg bg-dark">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="align-middle text-white" data-feather="book-open"></i>
                </div>
                <div class="flex-grow-1">
            <span class="d-block text-truncate text-white" style="max-width: 130px;">
                @if(Auth::user()->role == "school_admin")
                    {{Auth::user()->school->name}}
                @elseif(Auth::user()->role == "city_admin")
                    {{Auth::user()->city->name}}
                @endif

            </span>
                    @if(Auth::user()->role == "school_admin")
                        <small class="d-block text-white">{{Auth::user()->school->bin}}</small>
                    @endif

                </div>
            </div>

            <form action="{{route("logout-action")}}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 mt-3 rounded-3   hover-shadow">
                    <i class="bi bi-box-arrow-right me-2"></i> {{__('logout')}}
                </button>
            </form>

        </div>

    </div>
</nav>
