@extends('layouts.template')

@section('title', 'Басты бет')

@section('body')


    <div id="content">
        <nav class="navbar navbar-light bg-white shadow-sm mb-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h1>{{ __("title") }}</h1>
                    <div class="d-flex flex-column align-items-end">
                        <h1 id="current-time"></h1>
                        <h2 id="current-date"></h2>
                        <div>
                            <a href="{{ route('change.language', ['locale' => 'ru']) }}" class="btn btn-info">Русский</a>
                            <a href="{{ route('change.language', ['locale' => 'kk']) }}" class="btn btn-info">Қазақша</a>
                        </div>

                    </div>
                </div>
            </div>
        </nav>

        <div class="container d-flex justify-content-center align-items-center" style="height: 70vh;">
            <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px; border-radius: 12px; border: none;">
                <h2 class="text-center mb-4" style="color: #4a4a4a;">{{ __('terminal.title') }}</h2>

                @if($driveID)
                    <img class="qr-code" src="https://api.qrserver.com/v1/create-qr-code/?size=600x400&data={{ $driveID }}" alt="QR Code">
                    <p class="text-center mt-2">{{$driveID}}</p>

                @else
                    <p class="text-center">QR Code not available</p>
                @endif
            </div>
        </div>

    </div>
<style>
    .qr-code {
        width: 100%;
        max-width: 300px;
        height: auto;
        display: block;
        margin: 0 auto;
    }

</style>

@endsection
