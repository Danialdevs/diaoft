@extends("layouts/template")

@section("body")
    <div class="wrapper">

        @include("components.navbar")
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg d-flex justify-content-between">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div>
                    <a href="{{ route('change.language', ['locale' => 'ru']) }}" class="btn btn-info">Русский</a>
                    <a href="{{ route('change.language', ['locale' => 'kk']) }}" class="btn btn-info">Қазақша</a>
                </div>
            </nav>


            <main class="content">
                <div class="container-fluid p-0">

                    @yield("content")

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                            <p>2024 © {{__("title")}}</p>
                    </div>
                </div>
            </footer>

        </div>
    </div>
@endsection
