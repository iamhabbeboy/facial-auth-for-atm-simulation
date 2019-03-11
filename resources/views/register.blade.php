@extends('layouts.app')
@section('content')
<script src="/plugin/app.js"></script>
<script>
        $(function() {
          $('#start-camera').on('click', function() {
            let ml = new MLModule;
          });

          $('#accountBtn').click(function(e) {

          	const dob = $('#dob')
          	const state = $('#state');
          	const title = $('#title');
          	const other = $('#othername')
          	const country = $('#country');
          	const address = $('#address');
          	const surname = $('#surname');
          	const phone = $('#phone_number');
          	const email = $('#email_address');
          	const account_type = $('#account_type');

			if ( dob.val() == '' ) {
				dob.focus();
				return false;
			} else if ( email.val() == '') {
				email.focus();
				return false;
			} else if (!email.val().match(/^[a-zA-Z0-9_.]+@[a-zA-Z]+\.[(a-zA-Z.)]/)) {
				alert("Please enter valid email address")
				email.focus();
				return false;
			} else if (surname.val() == '' ) {
				surname.focus();
				return false;
			} else if ( other.val() == '') {
				other.focus();
				return false;
			} else if ( state.val() == '') {
				state.focus();
				return false;
			} else if (!state.val().match(/^[a-zA-Z\s]+$/)) {
				alert("Please enter letters and not wierd characters");
				state.focus();
				return false;
			} else if (phone.val() == '') {
				phone.focus();
				return false;
			} else if (!phone.val().match(/^([0-9]{11})+$/)) {
				alert("Please enter valid 11 phone number");
				phone.focus();
				return false;
			} else if (address.val() == '') {
				address.focus();
				return false;
			} else {
				$('#cameraModal').modal('show');
			}


          });

        })
       </script>
	<div class="container">
		<div style="margin-top: 50px;" class="col-md-10 offset-md-2">
			{{-- <form method="post" action="{{route('register_account')}}" id="ajaxForm"> --}}
				{{-- @csrf --}}
			<h2>ATM Simulation</h2>
				<hr>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Account Type</label>
						<select class="form-control" name="account_type" id="account_type">
							<option value="saving">Saving</option>
							<option value="current">Current</option>
						</select>
					</div>
					<div class="form-group">
						<label>Title</label>
						<select class="form-control" id="title">
							<option value="Mr">Mr.</option>
							<option value="Mrs">Mrs</option>
							<option value="Miss">Miss</option>
						</select>
						{{-- <input class="form-control" type="text" placeholder="Mr, Mrs, Miss" required name="title"> --}}
					</div>
					<div class="form-group">
						<label>Surname</label>
						<input class="form-control" type="text"  name="surname" id="surname">
					</div>
					<div class="form-group">
						<label>Other Name</label>
						<input class="form-control" type="text"  name="othername" id="othername">
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input class="form-control" type="text"  name="phone_number" id="phone_number">
					</div>

				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Date of birth</label>
						<input class="form-control" type="date" name="dob" id="dob">
					</div>
					<div class="form-group">
						<label>Email Address</label>
						<input class="form-control" type="text" name="email_address" id="email_address">
					</div>
					<div class="form-group">
						<label>Country</label>
						<select class="form-control" name="country" id="country">
							<option>Nigeria</option>
						</select>
					</div>
					<div class="form-group">
						<label>State</label>
						<input class="form-control" type="text" name="state" id="state">
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address" id="address"></textarea>
					</div>
					<input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
				</div>
			</div>
			<div class="divider">
                <button class="btn btn-lg btn-primary" id="accountBtn"
                {{-- data-toggle="modal" data-target="#cameraModal" --}}
                >Submit</button>
                {{-- <a href="#" data-toggle="modal" data-target="#cameraModal">Open Camera to register your face </a> --}}
			</div>

		{{-- </form> --}}
		</div>
		<hr>
    </div>

    @include('components.modal')
@stop
