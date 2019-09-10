@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>panel</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Monitors Table</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Number of Files</th>
                  <th>Last Updated</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($monitors as $key => $value)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$value->monitor_name}}</td>
                  <td>{{$value->count}}</td>
                  <td>{{$value->updated_at}}</td>
                  <td>
                    <a href="{{url('/')}}/monitors/search/{{$value->monitor_id}}" data-toggle="tooltip" title="View" style="padding: 0 5px;"><i class="fa fa-eye"></i></a>
                    <a href="#" data-toggle="tooltip" title="Edit" style="padding: 0 5px;"><i class="fa fa-edit"></i></a>
                    <a href="#" data-toggle="tooltip" title="Delete" style="padding: 0 5px;"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
