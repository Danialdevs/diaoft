@extends('layouts.template')

@section('title', 'Басты бет')

@section('body')



    <div id="no-internet-message" class=" justify-content-center align-items-center text-center" style="display: none; margin-top: 50vh;">
        <div class="text-center">
            <h4 class="text-danger">{{__('internet.missing')}}</h4>
            <p class="text-muted">{{__('internet.missing.description')}}</p>
        </div>
    </div>

    <div id="content" style="display: none;">
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
                <h2 class="text-center mb-4" style="color: #4a4a4a;">{{__('terminal.title')}}</h2>

                @if($school->activeLicenses->first())
                    <div id="class-selection">
                        <h4 class="card-title text-center" style="color: #6c757d;">{{__("terminal.select.grade")}}</h4>
                        <div class="d-flex flex-wrap justify-content-center mt-3">
                            @foreach(range(1, 11) as $class)
                                <button class="btn btn-outline-primary mx-2 mb-2"
                                        style="min-width: 80px;"
                                        onclick="showRatingSelection('{{ $class }}')">
                                    {{ $class }} - {{__('grade')}}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div id="rating-selection" style="display: none;">
                        <h4 class="card-title text-center" style="color: #6c757d;">{{__("terminal.select.rate")}}</h4>
                        <div class="d-flex justify-content-center mt-3">
                            <img src="https://img.icons8.com/?size=160&id=23WgxOsb7qe9&format=png&color=000000"
                                 alt="Хорошо"
                                 onclick="saveRating(100)"
                                 class="mx-2 mb-2">
                            <img src="https://img.icons8.com/?size=160&id=OPExqLhGyqfH&format=png&color=000000"
                                 alt="Средне"
                                 onclick="saveRating(50)"
                                 class="mx-2 mb-2">
                            <img src="https://img.icons8.com/?size=160&id=6FTUPpQ11L7I&format=png&color=000000"
                                 alt="Плохо"
                                 onclick="saveRating(0)"
                                 class="mx-2 mb-2">
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-secondary" onclick="goBackToClassSelection()">Назад</button>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <h4 class="text-danger">{{__('license.missing')}}</h4>
                            <p class="text-muted">{{__('license.missing.terminal')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let selectedClass = null;

        function checkInternetConnection() {
            if (!navigator.onLine) {
                document.getElementById('no-internet-message').style.display = 'block';
                document.getElementById('content').style.display = 'none';
            } else {
                document.getElementById('no-internet-message').style.display = 'none';
                document.getElementById('content').style.display = 'block';
            }
        }

        function updateTimeAndDate() {
            const now = new Date();
            const time = now.toLocaleTimeString();
            const date = now.toLocaleDateString();
            document.getElementById('current-time').innerText = time;
            document.getElementById('current-date').innerText = date;
        }

        setInterval(updateTimeAndDate, 1000);
        updateTimeAndDate();

        function showRatingSelection(className) {
            selectedClass = parseInt(className);
            document.getElementById('class-selection').style.display = 'none';
            document.getElementById('rating-selection').style.display = 'block';
        }

        // Вернуться к выбору класса
        function goBackToClassSelection() {
            document.getElementById('rating-selection').style.display = 'none';
            document.getElementById('class-selection').style.display = 'block';
        }

        // Сохранение выбранной оценки
        async function saveRating(rating) {
            if (!selectedClass) {
                alert('Выберите класс перед оценкой.');
                return;
            }

            const data = {
                grade: selectedClass,
                score: rating
            };

            try {
                const response = await fetch("{{ route('terminal.rate', [ 'id' => $school->id]) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });
            } catch (error) {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при сохранении оценки.');
            }

            goBackToClassSelection(); // Вернуться к выбору класса
        }

        // Проверка подключения при загрузке страницы
        checkInternetConnection();
        window.addEventListener('online', checkInternetConnection);
        window.addEventListener('offline', checkInternetConnection);
    </script>

    <style>
        #technical-work-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: flex-end;
            font-weight: bold;
            z-index: 9999;
            pointer-events: all;
        }

        #technical-work-overlay h1 {
            margin: 0;
            color: red;
            text-align: left;
            opacity: 0.35;
            font-size: 5rem;
            padding-bottom: 20px;
            padding-left: 20px;
        }

    </style>
@endsection
