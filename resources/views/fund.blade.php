@extends('layouts.app')
@section('content')
	<div class="container">
		<div style="margin-top: 50px;">
			<div class="row">
				<div class="col-md-3">
				  @include('components.sidebar')

					<hr>
          <div class="alert alert-info">
            <b> Fund Account </b>

          </div>
        <div class="row">
          <div class="col-md-6">
          <form action="/fund-acct" method="post">
            @if (Session::has('error'))
              <div class="alert-success alert">{{session('error')}}</div>
            @endif
          @csrf
            <label>Amount</label>
            <input type="text" class="form-control" name="amount" value="0.0">
            <p></p>
            <button class="btn btn-primary btn-sm">Fund Account</button>
          </form>
          </div>
        </div>
				</div>

			</div>
		</div>
		<hr>
	</div>

@stop