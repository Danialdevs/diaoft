@extends("layouts.admin-template")

@section("content")
        <h1 class="h3 mb-4">Школы</h1>

        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-light">
            <tr>
                <th>Школа</th>
                <th>Адрес</th>
                <th>Эл.почта</th>
                <th>БИН</th>
                <th>Кол-во терминалов</th>
                <th>Действия</th>
            </tr>
            </thead>
               @foreach($schools as $school)
                <tr>
                    <td><strong>{{$school->name}}</strong></td>
                    <td>{{$school->address}}</td>
                    <td>{{$school->contact_email}}</td>
                    <td>{{$school->bin}}</td>
                    <td>{{$school->devices->count()}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route("admin.system-install", $school->id)}}">Добавить устройство</a>
                    </td>

                </tr>
               @endforeach
            <tbody>



            </tbody>
        </table>

@endsection
