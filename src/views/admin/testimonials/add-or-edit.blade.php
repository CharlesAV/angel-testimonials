@extends('core::admin.template')

@section('title', ucfirst($action).' Testimonial')

@section('css')
@stop

@section('js')
	{{ HTML::script('packages/angel/core/js/ckeditor/ckeditor.js') }}
@stop

@section('content')
<h1>{{ ucfirst($action) }} Testimonial</h1>
@if ($action == 'edit')
	{{ Form::open(array('role'=>'form',
	'url'=>'admin/testimonials/delete/'.$testimonial->id,
	'class'=>'deleteForm',
	'data-confirm'=>'Delete this testimonial forever?  This action cannot be undone!')) }}
	<input type="submit" class="btn btn-sm btn-danger" value="Delete" />
	{{ Form::close() }}
@endif

@if ($action == 'edit')
	{{ Form::model($testimonial) }}
@elseif ($action == 'add')
	{{ Form::open(array('role'=>'form', 'method'=>'post')) }}
@endif

<div class="row">
	<div class="col-md-9">
		<table class="table table-striped">
			<tbody>
			@if (Config::get('core::languages'))
				<tr>
					<td>
						{{ Form::label('language_id', 'Language') }}
					</td>
					<td>
						<div style="width:300px">
							{{ Form::select('language_id', $language_drop, $active_language->id, array('class' => 'form-control')) }}
						</div>
					</td>
				</tr>
			@endif
				<tr>
					<td>
						{{ Form::label('author', 'Author') }}
					</td>
					<td>
						<div style="width:300px">
							{{ Form::text('author', null, array('class'=>'form-control', 'placeholder'=>'Author')) }}
						</div>
					</td>
				</tr>
				<tr>
					<td>
						{{ Form::label('position', 'Position') }}
					</td>
					<td>
						<div style="width:300px">
							{{ Form::text('position', null, array('class'=>'form-control', 'placeholder'=>'Position')) }}
						</div>
					</td>
				</tr>
				<tr>
					<td>
						{{ Form::label('html', 'Text') }}
					</td>
					<td>
						{{ Form::textarea('html', null, array('class'=>'ckeditor')) }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>{{-- Left Column --}}
</div>{{-- Row --}}
<div class="text-right pad">
	<input type="submit" class="btn btn-primary" value="Save" />
</div>
{{ Form::close() }}
@stop
