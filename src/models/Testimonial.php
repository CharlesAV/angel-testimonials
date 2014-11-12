<?php namespace Angel\Testimonials;

use App, Config, Eloquent;

class Testimonial extends Eloquent {

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
	
	public function search($terms)
	{
		return static::where(function($query) use ($terms) {
			foreach ($terms as $term) {
				$query->orWhere('author', 'like', $term);
				$query->orWhere('position', 'like', $term);
				$query->orWhere('plaintext', 'like', $term);
			}
		})->get();
	}
}
