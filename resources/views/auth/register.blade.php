@extends('layout.master')
@section('title', 'Login your account')
@section('content')
<div class="container-fluid" style="">
		<div class="container">
            <div class="col-md-6 col-md-offset-3 card" style="margin-top: 3%; margin-bottom: 3%; background-color: #E0E0E0;">
                <h3 style="margin-top: 3%; margin-bottom: 3%;">Register with Us, or <a href="{{ route('login') }}">Log In</a> or return <a href="/">Home</a></h3>
                <form class="form" role="form" method="POST" action="{{ route('postSignup') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                        @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                        @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Register
                        </button>
                    </div>
                </form>
            </div>
		</div>
</div>
@endsection
