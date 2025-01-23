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
                <th>Действия</th>
            </tr>
            </thead>
               @foreach($schools as $school)
                <tr>
                    <td><strong>{{$school->name}}</strong></td>
                    <td>{{$school->address}}</td>
                    <td>{{$school->contact_email}}</td>
                    <td>{{$school->bin}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route("admin.schools-edit", $school->id)}}">Редактировать</a>
                        <a href="#" class="btn btn-primary" id="license-add-button" data-id="{{$school->id}}" data-bs-toggle="modal" data-bs-target="#modal-license">
                            Выдать лицензию
                        </a>
                    </td>

                </tr>
               @endforeach
            <tbody>



            </tbody>
        </table>
        <div class="modal modal-blur fade" id="modal-license" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Выдать лицензию</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="licenseForm" action="{{route('admin.schools-add-license', ['id' => 0])}}" method="post">
                    @csrf
                    <div class="modal-body">

                          <div class="mb-3">
                              <label class="form-label">Выдано</label>
                              <input type="date" class="form-control" name="issue_date">
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Закончится</label>
                              <input type="date" class="form-control" name="expiry_date">
                          </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal-license');
        const issue_date = document.getElementsByName("issue_date")[0];
        const expiry_date = document.getElementsByName("expiry_date")[0];
        const form = document.getElementById('licenseForm');
        const licenseButtons = document.querySelectorAll("#license-add-button");

        licenseButtons.forEach(button => {
            button.addEventListener('click', () => {
                const schoolId = button.getAttribute('data-id');
                issue_date.value = ""
                expiry_date.value = ""
                form.action = `{{ route('admin.schools-add-license', '') }}/${schoolId}`;
            });
        });
    });

</script>
@endsection
