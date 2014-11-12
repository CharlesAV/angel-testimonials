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
	
	public static function columns()
	{
		$columns = array(
			'author',
			'position',
			'html'
		);
		if (Config::get('core::languages')) $columns[] = 'language_id';
		return $columns;
	}

	public function validate_rules()
	{
		return array(
			'author' => 'required',
			'html' => 'required'
		);
	}
	
	public function after_save($testimonial, &$changes = array())
	{
		$testimonial->plaintext = strip_tags($testimonial->html);
		$testimonial->save();
	}

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