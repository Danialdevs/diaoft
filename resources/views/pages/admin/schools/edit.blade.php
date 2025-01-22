@extends("layouts.admin-template")

@section("content")
    <h1 class="h3 mb-4">{{$school->name}}</h1>

   <div class="card p-3">
       <form>
           <div class="form-group mb-3">
               <label>Школа</label>
               <input type="text" class="form-control"  value="{{$school->name}}">
           </div>

           <div class="form-group mb-3">
               <label>Адрес</label>
               <input type="text" class="form-control"  value="{{$school->address}}">
           </div>

           <div class="form-group mb-3">
               <label>Почта</label>
               <input type="email" class="form-control"  value="{{$school->contact_email}}">
           </div>

           <div class="form-group mb-3">
               <label>БИН</label>
               <input type="number" class="form-control"  value="{{$school->bin}}">
           </div>

           <div class="form-group mb-3">
               <label>Город</label>
               <select class="form-control"  >
                   @foreach($cities as $city)
                       <option>{{$city->name}}</option>
                   @endforeach
               </select>
           </div>

           <button type="submit" class="btn btn-primary">Сохранить</button>
       </form>
   </div>
@endsection
