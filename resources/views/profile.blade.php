@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      User
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Profile Details</h3>
        </div>
        <form method="post" action="{{url('/')}}/profile/update">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" name="name" value="{{Auth::user()->name}}">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" name="email" value="{{Auth::user()->email}}">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Github Token</label>
                  <input class="form-control" name="github_token" value="{{$user->github_token}}">
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="row">
              <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </form>
      </div>
  </section>
</div>
@endsection
