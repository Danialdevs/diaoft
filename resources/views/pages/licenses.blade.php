@extends("layouts.admin-template")

@section("content")

    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="mb-4" style="font-size: 1.8rem; color: #2c3e50;">{{ __('my_active_license') }}</h2>
                <div class="card shadow-sm p-4">

                    @if ($activeLicense)
                        <p><strong>{{ __('license_number:') }}</strong> {{ $activeLicense->license_number }}</p>
                        <p><strong>{{ __('status:') }}</strong>
                            @if($activeLicense->type = "active")
                                <span class="badge bg-success">{{ __('active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('expired') }}</span>
                            @endif
                        </p>
                        <p><strong>{{ __('issued:') }}</strong> {{$activeLicense->issue_date}}</p>
                        <p><strong>{{ __('valid_until:') }}</strong> {{$activeLicense->expiry_date}}</p>
                    @else
                        <p><strong>{{ __('subscription_not_found_please_activate_your_subscription_to_gain_access.') }}</strong></p>
                    @endif

                </div>

            </div>
            <div class="col-md-6">
                <h2 class="mb-4" style="font-size: 1.8rem; color: #2c3e50;">{{ __('price_list') }}</h2>
                <div class="card shadow-sm p-4">
                    <ul class="list-unstyled">
                        <li>
                            <h4 class="mb-2" style="font-size: 1.4rem; color: #2c3e50;"><strong>{{ __('annual_license') }}</strong></h4>
                            <p>
                                {{ __('for_detailed_information_and_purchase_please_contact_us.') }}
                            </p>
                            <a href="tel:+77078397788" class="btn btn-outline-primary btn-lg mt-3" style="transition: background-color 0.3s, color 0.3s;">
                                {{ __('contact_for_details') }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div>
            <h2 class="mb-4" style="font-size: 1.8rem; color: #2c3e50;">{{ __('list_of_all_licenses') }}</h2>
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-light">
                <tr>
                    <th>{{ __('number') }}</th>
                    <th>{{ __('status') }}</th>
                    <th>{{ __('valid_until') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($licenses as $license)
                    <tr>
                        <td>{{$license->license_number}}</td>
                        <td>
                            @if($license->type = "active")
                                <span class="badge bg-success">{{ __('active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('expired') }}</span>
                            @endif
                        </td>
                        <td>{{$license->expiry_date}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
