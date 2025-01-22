@extends('layouts.admin-template')

@section('title', 'License Management')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="text-center">
            <h1 class="mb-4" style="font-size: 2rem; font-weight: 600; color: #2c3e50;">
              {{__("license.missing")}}
            </h1>
            <p class="mb-4" style="color: #7f8c8d; font-size: 1.1rem; line-height: 1.6;">
                {{__("license.missing.description")}}

            </p>
            <a href="{{route("licenses")}}" class="btn btn-outline-primary btn-lg px-5 py-2" style="font-size: 1rem;">
                {{__("license.cta")}}
            </a>
        </div>
    </div>
@endsection
