<?php namespace Angel\Testimonials;

use Angel\Core\AdminCrudController;
use App, View;

class AdminTestimonialController extends AdminCrudController {
	protected $Model	= 'Testimonial';
	protected $uri		= 'testimonials';
	protected $plural	= 'testimonials';
	protected $singular = 'testimonial';
	protected $package	= 'testimonials';
	protected $reorderable = true;

	public function edit($id)
	{
		$Testimonial = App::make($this->Model);

		$testimonial = $Testimonial::withTrashed()->find($id);
		$this->data['testimonial'] = $testimonial;
		$this->data['changes'] = $testimonial->changes();
		$this->data['action'] = 'edit';

		return View::make($this->package . '::admin.testimonials.add-or-edit', $this->data);
	}
}