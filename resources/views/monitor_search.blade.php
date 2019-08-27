@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Monitor Search</h3>
      </div>
      <div class="box-body">
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>File</th>
                <th>Repository</th>
                <th>Url</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($searches as $key => $value)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$value['filename']}}</td>
                <td>{{$value['repository']}}</td>
                <td><a href="{{$value['html_url']}}">Link</a></td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
