@extends('layouts.app')
@section('content')

	<div class="container">
		<div style="margin-top: 50px;">
			<div class="row">
				<div class="col-md-3">
					@include('components.sidebar')

					<hr>
          <div class="alert alert-info">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.</p>
          </div>
          @if (count($model))
            {{-- {{dd(array_get($model, 'bank_details'))}} --}}
            <table class="table table-striped" style="font-size: 13px;">
              <tr>
                <th>#</th>
                <th>Description</th>
                <th> Transaction Type </th>
                <th>Balance</th>
                <th>Date</th>
              </tr>
              @foreach (array_get($model, 'bank_details') as $key => $detail)
                <tr>
                  <td>{{$key+1}}</td>
                  <td> {{array_get($detail, 'desc')}}</td>
                  <td> {{array_get($detail, 'transaction_type')}}</td>
                  <td> @money(array_get($detail, 'amount'), 'NGN')</td>
                  <td> {{array_get($detail, 'created_at')}}</td>
                </tr>
              @endforeach
            </table>
          @endif

				</div>

			</div>
		</div>
		<hr>
	</div>
@stop