<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\CustomValidator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      \Validator::resolver(function ($translator, $data, $rules, $messages) {
          return new Domain\CustomValidator($translator, $data, $rules, $messages);
      });
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
