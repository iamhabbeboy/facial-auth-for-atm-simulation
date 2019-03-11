@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ATM Simulation using Facial recognition for verification</div>

                <div class="card-body">
                    <p>ATM simulation using facial recognition is a platform built with PHP to enable facial verification during fund transfer.</p>
                    <hr>
                      <p>ATM simulation using facial recognition is a platform built with PHP to enable facial verification during fund transfer.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login &raquo;</div>

                <div class="card-body">
                    <form method="post" action="/login">
                        @csrf
                        @if (Session::has('error'))
                            <div class="alert-danger alert">{{session('error')}}</div>
                        @endif
                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control" type="text" required="" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" required name="password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-lg">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
