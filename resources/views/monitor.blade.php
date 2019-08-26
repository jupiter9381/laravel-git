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
        <form role="form">
          <div class="box-body">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Name</label>
                <textarea class="form-control" rows="6" placeholder="exmaple.com"></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Search Strings</label>
              <div class="form-group">
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> Password</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> API_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> Secret_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> Aws_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> FTP_key</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> Login</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red" checked> Github_token</label>
                <label class="monitor_field"><input type="checkbox" class="flat-red"> Other</label>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection
