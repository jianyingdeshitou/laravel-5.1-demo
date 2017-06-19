<?php
namespace Furbook\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\View\Factory as ViewFactory;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
//    public function boot()
//    {
//        //
//    }

    public function boot(ViewFactory $view) {
        $view->composer('partials.forms.cat',
            'Furbook\Http\Views\Composers\CatFormComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
