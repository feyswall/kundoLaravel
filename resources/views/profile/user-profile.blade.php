@extends('layouts.super_system')

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
          <h5 class="my-3">Ed Eddy</h5>
          <p class="text-muted mb-1">Cheo</p>
          <p class="text-muted mb-4">Anuani</p>
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
              <p class="text-muted mb-0">Ed Edd Eddy</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Barua Pepe</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">mtumiaji@dedeplayo.com</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Namba Ya Simu</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">07xxxxxx</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Anuani</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">Kichuguu, Dar es Salaam, TZ</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Nywila</p>
            </div>
            <div class="col-sm-9 d-flex justify-content-between align-items-center">
              <p class="text-muted mb-0">xxxxxxxxxxxx</p>
              <a data-bs-toggle="modal" data-bs-target="#badilishaNywilaModal" href="#">
                <i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="left" title="Badilisha Nywila"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<x-system.modal id="badilishaNywilaModal" aria="badilishaNywilaModalLabel" size="modal-lg" title="Badilisha Nywila">
  <x-slot:content>
    <form method="post" action="">
      <div class="row">
        <div class="col-12">
          <div class="mb-3 mb-4">
            <label class="form-label" for="firstName">Nywila ya Zamani</label>
            <input type="password" class="form-control" name="firstName" value="">
          </div>
        </div>
        <di class="row">
          <div class="col-sm-12 col-md-6">
            <div class="mb-3 mb-4">
              <label class="form-label" for="middleName">Nywila Mpya</label>
              <input type="password" class="form-control" name="middleName" value="">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="mb-3 mb-4">
              <label class="form-label" for="lastName">Rudia Nyila Mpya</label>
              <input type="password" class="form-control" name="lastName" value="">
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
    <form method="post" action="">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="mb-3 mb-4">
            <label class="form-label" for="firstName">Jina La Kwanza</label>
            <input type="text" class="form-control" name="firstName" value="">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="mb-3 mb-4">
            <label class="form-label" for="middleName">Jina La Kati</label>
            <input type="text" class="form-control" name="middleName" value="">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="mb-3 mb-4">
            <label class="form-label" for="lastName">Jila La Mwisho</label>
            <input type="text" class="form-control" name="lastName" value="">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="mb-3 mb-4">
            <label class="form-label" for="firstName">Barua Pepe</label>
            <input type="text" class="form-control" name="email" value="">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="mb-3 mb-4">
            <label class="form-label" for="middleName">Namba ya Simu</label>
            <input type="text" class="form-control" name="phone" value="">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="mb-3 mb-4">
            <label class="form-label" for="lastName">Anuani</label>
            <input type="text" class="form-control" name="address" value="">
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