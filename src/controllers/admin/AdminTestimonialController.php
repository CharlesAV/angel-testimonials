<?php namespace Angel\Testimonials;

use Angel\Core\AdminCrudController;
use App, Input, View, Validator, Config;

class AdminTestimonialController extends AdminCrudController {
	protected $Model	= 'Testimonial';
	protected $uri		= 'testimonials';
	protected $plural	= 'testimonials';
	protected $singular = 'testimonial';
	protected $package	= 'testimonials';
	protected $reorderable = true;

	protected $log_changes = true;
	protected $searchable = array(
		'author',
		'position',
		'plaintext'
	);

	// Columns to update on edit/add
	protected static function columns()
	{
		$columns = array(
			'author',
			'position',
			'html'
		);
		if (Config::get('core::languages')) $columns[] = 'language_id';
		return $columns;
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

	/**
	 * Validate all input when adding or editing a testimonial.
	 *
	 * @param array &$custom - This array is initialized by this function.  Its purpose is to
	 * 							exclude certain columns that require intervention of some kind (such as
	 * 							checkboxes because they aren't included in input on submission)
	 * @param int $id - (Optional) ID of testimonial beind edited
	 * @return array - An array of error messages to show why validation failed
	 */
	public function validate(&$custom, $id = null)
	{
		$errors = array();
		$rules = array(
			'author' => 'required',
			'html' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			foreach($validator->messages()->all() as $error) {
				$errors[] = $error;
			}
		}
		
		$custom = array();

		return $errors;
	}
}