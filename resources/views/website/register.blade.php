@extends('layout.master')
@section('title', 'Login your account')
@section('content')
@include('partial.top-navbar')
<div class="container-fluid" style="">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 card" style="margin-top: 3%; margin-bottom: 3%; background-color: #E0E0E0;">
                <form role="form" method="POST" action="{{ route('register-website') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                        <label for="domain">Domain</label>
                        <input type="domain" class="form-control" id="domain" name="domain" value="{{ old('domain') }}">
                        @if ($errors->has('domain'))
                        <span class="help-block">
                            <strong>{{ $errors->first('domain') }}</strong>
                        </span>
                        @endif
                    </div>
                    <!-- <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="status">Status</label>
                        <input type="status" class="form-control" id="status" name="status">
                        @if ($errors->has('status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                        @endif
                    </div> -->
                    <div class="form-group">
                    <button type="submit" class="btn btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
            
        </div>
</div>
@endsection