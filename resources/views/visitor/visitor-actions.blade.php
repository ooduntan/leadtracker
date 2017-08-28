@extends('layout.master')
@section('title', 'Visitors by action')
@section('content')
@include('partial.top-navbar')
<div class="container">
@if (is_null($category) || empty($category) )
<h3>Unclassified</h3>
@else
<h3>{{ $category->name }}</h3>
@endif
<table class="table table-hover table-bordered table-striped" style="margin-top: 20px;">
	<thead>
		<tr>
			<th>Company</th>
			<th>Postal Code</th>
			<th>City</th>
			<th>Country</th>
			<th>Last Visits</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@if (count($visitors) > 0)
		@foreach ($visitors as $visitor)
		<tr>
			<td><a href="/visitor/{{ $visitor->id }}/details">{{ $visitor->company }}</a></td>
			<td>{{ $visitor->postal_code }}</td>
			<td>{{ $visitor->city }}</td>
			<td>{{ $visitor->country }}</td>
			<td>{{ Carbon\Carbon::createFromTimeStamp(strtotime($visitor->last_seeen))->toDateTimeString() }}</td>
			@if (is_null($visitor->category_id) || empty($visitor->category_id))
			<td>
				<select class="form-control category" visitor-id={{ $visitor->id }}>
				   @if($visitor->status === 0) <option 
                                selected="selected"
                            >Unclassified</option>@endif
				    @foreach ($categories as $category)
				    	<option value="{{ $category->id }}"  @if($visitor->status === 1) @if($visitor->category_id == $category->id)
                            selected="selected"
                            @endif
                 			@endif
				    	    >{{ $category->name }}
				    	</option> 
				    @endforeach
				</select>
			</td>
			@else
			<td>Open</td>
			@endif
			
		</tr>
		@endforeach
		@endif
		
		</tbody>
</table>
</div>
@endsection