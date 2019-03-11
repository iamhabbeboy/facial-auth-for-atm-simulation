@extends('layouts.app')
@section('content')
	<div class="container">
		<div style="margin-top: 50px;">
			<div class="row">
				<div class="col-md-3">
				  @include('components.sidebar')

					<hr>
          <div class="alert alert-info">
            <b> Withdrawal </b>

          </div>
        <div class="row">
          <div class="col-md-6">
          <form action="" method="post">
            <label>Account Type</label>
            <select class="form-control">
              <option value="saving">Saving</option>
              <option value="current">Current</option>
            </select>
            <label>Amount</label>
            <select class="form-control">
              <option value="1000">&#8358; 1,000</option>
              <option value="2000">&#8358; 2,000</option>
              <option value="5000">&#8358; 5000</option>
              <option value="10000">&#8358; 10,000</option>
              <option value="2000">&#8358; 20,000</option>
              <option value="other">other </option>
            </select>
            <input type="text" class="form-control" name="amount" value="0.0" style="display: none">
            <p></p>
            <button class="btn btn-primary btn-sm">Submit</button>
          </form>
          </div>
        </div>
				</div>

			</div>
		</div>
		<hr>
	</div>

@stop