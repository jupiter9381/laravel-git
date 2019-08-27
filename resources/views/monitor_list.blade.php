@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Monitors Table</h3>
      </div>
      <div class="box-body">
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Password</th>
                <th>API</th>
                <th>Secret</th>
                <th>AWS</th>
                <th>FTP</th>
                <th>Login</th>
                <th>Github</th>
                <th>Other</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($monitors as $key => $value)
                <tr>
                  <td>{{$value->name}}</td>
                  <td><i class="fa <?php echo $value->password == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td><i class="fa <?php echo $value->api_key == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td><i class="fa <?php echo $value->secret_key == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td><i class="fa <?php echo $value->aws_key == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td><i class="fa <?php echo $value->ftp == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td><i class="fa <?php echo $value->login == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td><i class="fa <?php echo $value->github == "1" ? "fa-check" : "fa-times" ;?>"></i></td>
                  <td>{{$value->other}}</td>
                  <td><a href="{{url('/')}}/monitors/search/{{$value->id}}"><i class="fa fa-eye"></i></a></td>
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
