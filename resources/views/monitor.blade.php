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
        <form role="form" method="post" action="{{url('/')}}/monitors/add_monitor" id="monitor-form">
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Modal -->
  <div id="paymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default credit-card-box">
                      <div class="panel-heading display-table" >
                          <div class="row display-tr" >
                              <div class="display-td" >
                                  <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                              </div>
                          </div>
                      </div>
                      <div class="panel-body">

                          @if (Session::has('success'))
                              <div class="alert alert-success text-center">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                  <p>{{ Session::get('success') }}</p>
                              </div>
                          @endif

                          <form role="form" action="" method="post" class="require-validation"
                                                           data-cc-on-file="false"
                                                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                          id="payment-form">
                              @csrf
                              <input type="hidden" name="name">
                              <div class='form-row row'>
                                  <div class='col-xs-12 form-group required'>
                                      <label class='control-label'>Name on Card</label> <input
                                          class='form-control' size='4' type='text'>
                                  </div>
                              </div>

                              <div class='form-row row'>
                                  <div class='col-xs-12 form-group card required'>
                                      <label class='control-label'>Card Number</label> <input
                                          autocomplete='off' class='form-control card-number' size='20'
                                          type='text'>
                                  </div>
                              </div>

                              <div class='form-row row'>
                                  <div class='col-xs-12 col-md-4 form-group cvc required'>
                                      <label class='control-label'>CVC</label> <input autocomplete='off'


                                          class='form-control card-cvc' placeholder='ex. 311' size='4'
                                          type='text'>
                                  </div>
                                  <div class='col-xs-12 col-md-4 form-group expiration required'>
                                      <label class='control-label'>Expiration Month</label> <input
                                          class='form-control card-expiry-month' placeholder='MM' size='2'
                                          type='text'>
                                  </div>
                                  <div class='col-xs-12 col-md-4 form-group expiration required'>
                                      <label class='control-label'>Expiration Year</label> <input
                                          class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                          type='text'>
                                  </div>
                              </div>

                              <div class='form-row row'>
                                  <div class='col-md-12 error form-group hide'>
                                      <div class='alert-danger alert'>Please correct the errors and try
                                          again.</div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-xs-12">
                                      <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
