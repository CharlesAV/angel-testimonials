<?php namespace Angel\Testimonials;

use Illuminate\Support\ServiceProvider;

class TestimonialsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('angel/testimonials');
		
		include __DIR__ . '../../../routes.php';

		$bindings = array(
			// Models
			'Testimonial'        => '\Angel\Testimonials\Testimonial',
	
			// Controllers
			'TestimonialController'			=> '\Angel\Testimonials\TestimonialController',
			'AdminTestimonialController'	=> '\Angel\Testimonials\AdminTestimonialController'
		);
		
		foreach ($bindings as $name=>$class) {
			$this->app->singleton($name, function() use ($class) {
				return new $class;
			});
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
