@extends('core::template')

@section('title','Testimonials')

@section('content')
	<div class="row">
		<h1>Testimonials</h1>
		@foreach($testimonials as $testimonial) 
		<div class="testimonial-item">
			<div class="testimonial-html">
				{{ $testimonial->html }}
			</div>
			<div class="testimonial-author">-{{ $testimonial->author }}</div>
			@if($testimonial->position) 
			<div class="testimonial-position">&nbsp;<em>{{ $testimonial->position }}</em></div>
			@endif
			<hr />
		</div>
		@endforeach
	</div>
@stop