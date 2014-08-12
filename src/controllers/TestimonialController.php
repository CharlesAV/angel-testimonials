<?php namespace Angel\Testimonials;

use App, View;

class TestimonialController extends \Angel\Core\AngelController {
	
	public function __construct()
	{
		$this->Testimonial = $this->data['Testimonial'] = App::make('Testimonial');

		parent::__construct();
	}
	
	function index()
	{
		// Query
		$this->data['testimonials'] = $this->Testimonial
			->orderBy('order','asc')
			->get();
			
		// Return
		return View::make('testimonials::testimonials.index',$this->data);
	}
}