@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Monitor Search ( {{$monitor->name}} )</h3>
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
                <th>Download</th>
              </tr>
            </thead>
            <tbody>
              @foreach($searches as $key => $value)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$value->filename}}</td>
                <td>{{$value->repository}}</td>
                <td><a href="#snippetModal" data-toggle="modal" url="{{$value->url}}" class="link">Link</a></td>
                <td>
                  <?php if($value->isDownloaded != '1'){?>
                  <a href="{{url('/')}}/monitors/download/{{$value->id}}">Download</a>
                  <?php } else {?>
                  <?php }?>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="snippetModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Code Snippet</h4>
          </div>
          <div class="modal-body">
            <textarea class="form-control code_field" rows="30"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </section>
</div>
@endsection
