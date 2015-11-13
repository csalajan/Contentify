<?php namespace App\Modules\Participants\Providers;

use Illuminate\Support\ServiceProvider;
use App, Lang, View;

class ParticipantsServiceProvider extends ServiceProvider {

    public function register()
    {
        App::register('App\Modules\Participants\Providers\RouteServiceProvider');

        Lang::addNamespace('participants', realpath(__DIR__.'/../Resources/Lang'));

        View::addNamespace('participants', realpath(__DIR__.'/../Resources/Views'));
    }

}