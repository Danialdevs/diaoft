@extends("layouts/template") @section("body")
    <div class="page">

        @include("components.navbar")

        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">@yield("content")</div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row align-items-center flex-row-reverse text-center">
                        <div class="col-12 col-lg-auto mt-lg-0 mt-3">
                            <ul class="list-inline list-inline-dots mb-0">
                                <p>2024 © {{__("title")}}</p>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

@endsection
