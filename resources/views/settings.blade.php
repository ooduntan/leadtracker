@extends('layout.master')
@section('title', 'Visitor detail')
@section('content')
@include('partial.top-navbar')
<div class="container">
	<div class="row">
	  <div class="col-md-6" style="background-color: #E0E0E0;">
	  <h6 style="color: red;">Your Profile</h6>
	  	<img width="60" height="60" src="{{ asset('download.png') }}" alt="banner-img">
	  	Microsoft Crop.
	  	<p>www.microsoft.com</p>
	  </div>
	  <div class="col-md-5" style="background-color: #E0E0E0; margin-left: 15px;">
	  	<div class="col-md-6">
	  		<div class="row">
	  			<h4 style="color: red;">Your Subscription</h5>
	  		</div>
	  		<p>Domains: 2 of 3</p>
	  		<p>Users: 2 of 5</p>
	  		<p>Valid until: 2017-12-31</p>
	  	</div>
  		<div class="col-md-6">
  			<h2 style="color: blue; margin-bottom: 0.3px;">BASIC</h2>
  			<a class="btn btn-default btn-xs" href="#" role="button">Upgrade</a>
  		</div>
	  </div>
	</div>

	<div class="row">
		<div class="col-md-11" style="background-color: #E0E0E0;  margin-top: 10px;">
  		<h4 style="color: red;">Websites</h5>
  		<table class="table table-hover table-bordered table-striped" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>Website</th>
					<th>Tracking Code</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($websites as $website)
				<tr>
					
					<td>
						{{ $website->domain }}
					</td>
					<td>
						
					</td>
					<td>
						@if ($website->status == 1)
							Active
						@else
							Looking for tracking Code
						@endif
					</td>
					<td>
						<button class="btn btn-default"> Delete</button>
					</td>
					
				</tr>
				@endforeach
			</tbody>

		</table>
		<button type="button" class="btn btn-primary btn-sm">Add Website</button>
	</div>
	</div>
	
	<div class="row">
		<div class="col-md-11" style="background-color: #E0E0E0;  margin-top: 10px;">
  		<h4 style="color: red;">Users</h5>
  		<table class="table table-hover table-bordered table-striped" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>E-mail</th>
					<th>Role</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					
					<td>
						John
					</td>
					<td>
						Doe
					</td>
					<td>
						john.doe@microsoft.com
					</td>
					<td>
						Administrator
					</td>
					<td>
						<button class="btn btn-default"> Edit</button>
					</td>
					
				</tr>
			</tbody>
		</table>
		<button type="button" class="btn btn-primary btn-sm">Add User</button>
	</div>
	</div>
</div>
@endsection