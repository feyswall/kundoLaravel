@extends('layouts.mbunge_system')

@section('content')
<div class="container">
  <div class="row">
    <div class="col d-flex flex-column flex-md-row justify-content-md-between justify-content-center items-center mb-3 flex-column-reverse">
      <h3 class="fs-4 me-3">Taarifa za Mtumiaji</h3>
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Profile</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
     <div class="col-lg-4">
      <div class="card mb-4">
        <div class="card-body text-center">
          <img src="" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
          <h5 class="my-3">{{$user->name}}</h5>
          <p class="text-muted mb-1">Admin</p>
          <p class="text-muted mb-4">{{$user->email}}</p>
          <button type="button" class="btn btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#badilishaTaarifaModal">Badilisha</button>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Jina Kamili</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{$user->name}}</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Barua Pepe</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{$user->email}}</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Nywila</p>
            </div>
            <div class="col-sm-9 " data-bs-toggle="modal" data-bs-target="#badilishaNywilaModal">
              <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted mb-0">xxxxxxxxxxxx</p>
                <a href="#">
                  <i class="fas fa-edit"></i>
                  <span>Badilisha Nywila</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<x-system.modal id="badilishaNywilaModal" aria="badilishaNywilaModalLabel" size="modal-lg" title="Badilisha Nywila">
  <x-slot:content>
    <form method="post" action="{{route('profile.password')}}">
      @method('patch')
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="mb-3 mb-4">
            <label class="form-label" for="old_password">Nywila ya Zamani</label>
            <input type="password" class="form-control" name="old_password" >
          </div>
        </div>
        <di class="row">
          <div class="col-sm-12 col-md-6">
            <div class="mb-3 mb-4">
              <label class="form-label" for="new_password">Nywila Mpya</label>
              <input type="password" class="form-control" name="new_password">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="mb-3 mb-4">
              <label class="form-label" for="confirm_password">Rudia Nyila Mpya</label>
              <input type="password" class="form-control" name="confirm_password">
            </div>
          </div>
        </di>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" name="submit" class="btn btn-primary btn-md">Wasilisha</button>
        </div>
      </div>
    </form>
  </x-slot:content>
</x-system.modal>
<x-system.modal id="badilishaTaarifaModal" aria="badilishaTaarifaModalLabel" size="modal-lg" title="Badilisha Taarifa Za Mtumiaji hapa">
  <x-slot:content>
    <form method="POST" action="{{route('profile.update')}}">
      @method('patch')
      @csrf
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="mb-3 mb-6">
            <label class="form-label" for="name">Jina kamili</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}">
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="mb-3 mb-6">
            <label class="form-label" for="email">Barua pepe</label>
            <input type="text" class="form-control" name="email" value="{{$user->email}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" name="submit" class="btn btn-primary btn-md">Wasilisha</button>
        </div>
      </div>
    </form>
  </x-slot:content>
</x-system.modal>
@endsection