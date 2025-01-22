@extends('layouts.template')

@section('title', 'Басты бет')

@section('body')

    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">{{__('title')}}</h1>
                            <p class="lead">
                                {{__('login.description')}}
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form method="POST" action="{{route("login-action")}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">{{__('login.email')}}</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                   placeholder="{{__('login.email.placeholder')}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{__('login.password')}}</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                   placeholder="{{__('login.password.placeholder')}}" required>
                                        </div>
                                        @if(Session::has('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{Session::get("error")}}
                                            </div>
                                        @endif

                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit"
                                                    class="btn btn-lg btn-primary">{{__('login.button')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
