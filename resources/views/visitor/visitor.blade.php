@extends('layout.master')
@section('title', 'Dashboard')
@section('content')
@include('partial.top-navbar')
<div class="container">
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
        <div class="row">
            <div class="filter-custom col-lg-4 pull-right">
                <div class="row">
	                <div class="filter-container col-lg-4 pull-right">
					<select class="form-control website">
					<option value="all" selected>All</option>
						@foreach ($websites as $website)
						
						
						<option value="{{ $website->id }}" 
							@if ($website == $website->domain) 
							selected="selected"

							@endif

						>{{ $website->domain }}
						@endforeach
						</option>
					</select>
					</div>
				</div>
			</div>
	    </div>
<table class="table table-hover table-bordered table-striped" style="margin-top: 20px;">
	<thead>
		<tr>
			<th>Date</th>
			<th>Company</th>
			<th>Description</th>
			<th>Postal Code</th>
			<th>City</th>
			<th>Country</th>
			<th>No of pages</th>
			<th>Time on site</th>
			<th>Source</th>
			<th>Links</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@if (count($visitors) > 0)
		@foreach ($visitors as $value)
		@foreach ($value as $visitor)
		<tr>
			<td>{{ Carbon\Carbon::createFromTimeStamp(strtotime($visitor->last_seeen))->toDateTimeString() }}</td>
			<td><a href="#">{{ $visitor->company }}</a></td>
			<td>{{ $visitor->description }}</td>
			<td>{{ $visitor->postal_code }}</td>
			<td>{{ $visitor->city }}</td>
			<td>{{ $visitor->country }}</td>
			<td></td>
			<td></td>
			<td>{{ $visitor->source }}</td>
			<td>
				@foreach (json_decode($visitor->links) as $link)
					{{ $link }}
				@endforeach
			</td>
			<td>
				<select class="form-control category" visitor-id={{ $visitor->id }}>
				   @if($visitor->status === 0) <option 
                                selected="selected"
                            >Unclassified</option>@endif
				    @foreach ($categories as $category)
				    	<option value="{{ $category->id }}"  @if($visitor->status === 1) @if($value == $category->name)
                                selected="selected"
                            @endif
                 			@endif
				    	>{{ $category->name }}

				    	</option> 

				    @endforeach
				</select>
			</td>
		</tr>
		@endforeach
		@endforeach
		@endif
		
		</tbody>
</table>
</div>
@endsection