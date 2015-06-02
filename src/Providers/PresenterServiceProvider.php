<?php namespace Motty\Presenter\Providers;

use Illuminate\Support\ServiceProvider;

use Motty\Presenter\LaravelPresenter;
use Motty\Presenter\Contracts\PresenterInterface;

class PresenterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerPresenter();
    }

    public function registerPresenter()
    {
        $this->app->bind(PresenterInterface::class, function () {
            return new LaravelPresenter();
        });
    }
}
