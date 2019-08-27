@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Monitor
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Monitor</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create new monitors</h3>
        </div>
        <form role="form" method="post" action="{{url('/')}}/monitors/add_monitor">
          @csrf
          <div class="box-body">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Name</label>
                <textarea class="form-control" rows="6" placeholder="exmaple.com" name="name"></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Search Strings</label>
              <div class="form-group">
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="password"> Password</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="api_key"> API_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="secret_key"> Secret_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="aws_key"> Aws_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="ftp_key"> FTP_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="login"> Login</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked name="github_token"> Github_token</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red other-checkbox"> Other</label>
                <input type="text" name="other" class="form-control other" style="display: none;" disabled>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection
