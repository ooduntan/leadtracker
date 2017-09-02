@extends('layout.master')
@section('title', 'Visitor detail')
@section('content')
@include('partial.top-navbar')
<div class="container">

<div class="row">
@if (session('message-success'))
  <div class="alert alert-success">
      {{ session('message-success') }}!
  </div>
@endif
@if (session('message-failure'))
  <div class="alert alert-success">
      {{ session('message-failure') }}!
  </div>
@endif
  <div class="col-md-4">
  	<div class="row" style="background-color: #E0E0E0";>
  		<h3>{{ $visitor->company }}</h3>
  	</div>
  	<div class="row" style="background-color: #E0E0E0; margin-top: 10px;">
  		<p><b> About {{ $visitor->company }}</b></p>
  		<form role="form" method="POST" action="/visitor/{{ $visitor->id }}/details">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
	            <label for="contact">Contact Name</label>
	            <input type="contact" class="form-control" id="contact" name="contact" value="{{ $visitor->contact }}">
	            @if ($errors->has('contact'))
	            <span class="help-block">
	                <strong>{{ $errors->first('contact') }}</strong>
	            </span>
	            @endif
	        </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $visitor->email }}">
              @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" value="{{ $visitor->phone }}">
              @if ($errors->has('phone'))
              <span class="help-block">
                  <strong>{{ $errors->first('phone') }}</strong>
              </span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('classification') ? ' has-error' : '' }}">
              <label for="classification">Classification</label>
              <select name="categoryId" class="form-control" visitor-id={{ $visitor->id }}>
           @if($visitor->status === 0) <option 
                                selected="selected"
                            >Unclassified</option>@endif
            @foreach ($categories as $category)
              <option name="categoryId" value="{{ $category->id }}"  @if($visitor->status === 1) @if($visitor->category_id == $category->id)
                            selected="selected"
                            @endif
                      @endif
                  >{{ $category->name }}
              </option> 
            @endforeach
        </select>
          </div>
          <div class="form-group pull-right">
        <button type="submit" class="btn btn btn-primary">Update</button>
        </div>
	    </form>
  	</div>
  	<div class="row" style="background-color: #E0E0E0; margin-top: 10px;">
  		<h5>Activity</h5>
      <div class="row" style="color: red;">
        <div class="col-md-6">
          <span>5</span>
          <p>Site Visit</p>
        </div>
        <div class="col-md-6">
          <span>12</span>
          <p>Pages viewed</p>
        </div>
      </div>
      <h7>Most recent visit</h7>
      <p>{{ Carbon\Carbon::createFromTimeStamp(strtotime($visitor->last_seeen))->toDayDateTimeString() }}</p>
    
      <h7>First seen</h7>
      <p>{{ Carbon\Carbon::createFromTimeStamp(strtotime($visitor->first_seeen))->toDayDateTimeString() }}</p>      
  	</div>
    </div>
  <div class="col-md-8">
  	<div class="row" style="background-color: #E0E0E0; margin-left: 5px;">

  		<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-ok" aria-hidden="true">New note</span></button>
      <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-ok" aria-hidden="true">Log activity</span></button>
  
      <form role="form" method="POST" action="" style="margin-top: 10px;">
        <div class="form-group">
          <textarea class="form-control"> </textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn btn-primary">Save</button>
          <button type="submit" class="btn btn btn-primary">Discard</button>
        </div>
      </form>
  	</div>

    <div class="row" style="margin-left: 20%; margin-top:20px;">
        <div class="row">
          <h4>August 2017</h4>
        </div>
      	<div class="row" style="background-color: #E0E0E0;">
            <p>Karl viewed our Home page</p>
            <p>August 3, 16:58</p>
      	</div>
        <div class="row" style="background-color: #E0E0E0; margin-top:5px;">
            <p>Karl viewed our product page</p>
            <p>August 5, 16:58</p>
        </div>
        <div class="row" style="background-color: #E0E0E0; margin-top:5px;">
            <p>Note</p>
            <p>Might be interesting Lead</p>
        </div>

        <div class="row">
          <h4>July 2017</h4>
        </div>
        <div class="row" style="background-color: #E0E0E0;">
            <p>Karl viewed our Home page</p>
            <p>July 13, 01:58</p>
        </div>
        <div class="row" style="background-color: #E0E0E0; margin-top:5px;">
            <p>Note</p>
            <p>Might be interesting Lead</p>
        </div>
    </div>
  </div>
</div>
</div>
