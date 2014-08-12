<?php namespace Angel\Testimonials;

use App, Config, Angel\Core\LinkableModel;

class Testimonial extends LinkableModel {
	///////////////////////////////////////////////
	//               Relationships               //
	///////////////////////////////////////////////
	public function changes()
	{
		$Change = App::make('Change');

		return $Change::where('fmodel', 'Testimonial')
				   	       ->where('fid', $this->id)
				   	       ->with('user')
				   	       ->orderBy('created_at', 'DESC')
				   	       ->get();
	}
	
	// Handling relationships in controller CRUD methods
	public function pre_delete()
	{
		parent::pre_delete();
		$Change = App::make('Change');
		$Change::where('fmodel', 'Testimonial')
			        ->where('fid', $this->id)
			        ->delete();
	}

	///////////////////////////////////////////////
	//               Menu Linkable               //
	///////////////////////////////////////////////
	// Menu link related methods - all menu-linkable models must have these
	// NOTE: Always pull models with their languages initially if you plan on using these!
	// Otherwise, you're going to be performing repeated queries.  Naughty.
	public function link() {}
	public function link_edit()
	{
		return admin_url('testimonials/edit/' . $this->id);
	}
}
