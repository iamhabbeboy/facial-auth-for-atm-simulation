@extends('layouts.app')
@section('content')
	<div class="container">
		<div style="margin-top: 50px;">
			<div class="row">
				<div class="col-md-3">
				  @include('components.sidebar')

					<hr>
          <div class="alert alert-info">
            <b> My Profile </b>

          </div>

             <form method="post" action="/profile-update">
              @csrf
              @if (Session::has('error'))
                <div class="alert-success alert">{{session('error')}}</div>
              @endif
              <label>Full Name </label>
              <input class="form-control" type="text" value="{{array_get($model, 'title')}} {{array_get($model, 'othername')}}, {{array_get($model, 'surname')}}" readonly="">
              <label>Email Address </label>
              <input class="form-control" type="text" value="{{array_get($model, 'email_address')}}" disabled>
              <label>Phone Number</label>
              <input class="form-control" type="text" name="phone_number" value="{{array_get($model, 'phone_number')}}">
              <label>Change Password </label>
              <input class="form-control" type="password" name="password">
              <br/>
              <button class="btn btn-primary btn-lg" type="submit">Submit</button>
            </form>
				</div>

			</div>
		</div>
		<hr>
	</div>

@stop