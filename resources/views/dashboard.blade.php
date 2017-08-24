@extends('layout.master')
@section('title', 'Dashboard')
@section('content')
@include('partial.top-navbar')
<div class="container">
  <p>
  @if (session('message-website'))
    <div class="alert alert-success">
        {{ session('message-website') }}!
    </div>
  @endif
</p>
	<div class="row" >
		<div class="col-md-12" style="background-color: #E0E0E0";>
			<p class="heading-title">Visits by day</p>
			<canvas id="barChart-vertical"></canvas>
		</div>
	</div>
  <div class="row" style="margin-top: 10px;">
    <div class="col-md-6" style="background-color: #E0E0E0";>
      <p class="heading-title">Most Recent visitors</p>
      <table class="table table-hover table-bordered table-striped">
      	<thead>
      		<tr>
      			<th>sn</th>
      			<th>1</th>
      			<th>2</th>
      			<th>4</th>
      			<th>5</th>
      			<th>6</th>
      			<th>7</th>
      		</tr>
      	</thead>
      	<tbody>
      		<tr>
      			<td>yellow</td>
      			<td>green</td>
      			<td>red</td>
      			<td>purple</td>
      			<td>white</td>
      			<td>black</td>
      			<td>violet</td>
      		</tr>
      	</tbody>
      </table>
    </div>
    <div class="col-md-6" style="background-color: #E0E0E0;"  >
      <p class="heading-title">Visit by source</p>
      <canvas id="barChart-horizontal"></canvas>
    </div>
  </div>

  <div class="row" style="margin-top: 10px;">
    <div class="col-md-6" style="background-color: #E0E0E0;">
      <p class="heading-title">Visitors Categories</p>
      <canvas id="myData"></canvas>
    </div>
    <div class="col-md-6" style="background-color: #E0E0E0;">
      <p class="heading-title">Returning visitors</p>
      <table class="table table-hover table-bordered table-striped">
      	<thead>
      		<tr>
      			<th>sn</th>
      			<th>1</th>
      			<th>2</th>
      			<th>4</th>
      			<th>5</th>
      			<th>6</th>
      			<th>7</th>
      		</tr>
      	</thead>
      	<tbody>
      		<tr>
      			<td>yellow</td>
      			<td>green</td>
      			<td>red</td>
      			<td>purple</td>
      			<td>white</td>
      			<td>black</td>
      			<td>violet</td>
      		</tr>
      	</tbody>
      </table>
    </div>
  </div>
  </div>
@endsection