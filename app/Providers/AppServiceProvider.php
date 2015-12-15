<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //App name for all view
        view()->share('APP_NAME', 'CRM');

        //Person
        view()->share('PERSON_TITLE', 'Customer');
        view()->share('PERSON_PREFIX', 'C');

        //User
        view()->share('USER_TITLE', 'User');
        view()->share('USER_PREFIX', 'U');

        //Transaction
        view()->share('TRANS_TITLE', 'Transaction');
        view()->share('TRANS_PREFIX', 'T');

        //Transaction
        view()->share('ITEM_TITLE', 'Product');
        view()->share('ITEM_PREFIX', 'P');            

        //Campaign
        view()->share('CAMPAIGN_TITLE', 'Event');
        view()->share('CAMPAIGN_PREFIX', 'E'); 

        //Scheduler
        view()->share('SCHEDULER_TITLE', 'Todo\'s');
        view()->share('SCHEDULER_PREFIX', 'D'); 

        //Market
        view()->share('MARKET_TITLE', 'Sales Pipeline');
        view()->share('MARKET_PREFIX', 'S');  

        //Market
        view()->share('REPORT_TITLE', 'Report');
        view()->share('REPORT_PREFIX', 'R');                                   

        //Email                              
        view()->share('EMAIL_TITLE', 'Contact');
        view()->share('EMAIL_PREFIX', '');   
                
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
