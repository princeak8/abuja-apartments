<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Repositories\MyFunction;

use App\Realtor;
use App\House;
use App\House_type;


class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer(['inc.realtor.top_menu', 'inc.realtor.header'], function ($view){
            $realtor = Realtor::find(Auth::user()->id);
            //$availableHouses = House::with([$realtor->AllMyhouses])->where('available', '1');
            //var_dump($availableHouses)
            $requests = $realtor->sent_share_requests->count() + $realtor->share_requests->count() + \App\Circle::SentRequests(Auth::user()->id)->count() + \App\Circle::CircleRequests(Auth::user()->id)->count();
            $view->with('requests', $requests);
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
