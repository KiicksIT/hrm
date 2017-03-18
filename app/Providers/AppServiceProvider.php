<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laracasts\Flash\Flash;

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
        view()->share('APP_NAME', 'HRM');

        //Person
        // view()->share('MAININDEX_TITLE', 'Dashboard');
        view()->share('MAININDEX_TITLE', 'Dashboard 仪表');
        view()->share('MAININDEX_PREFIX', 'B');

        //Person
        // view()->share('PERSON_TITLE', 'Employee');
        view()->share('PERSON_TITLE', 'Employee 员工');
        view()->share('PERSON_PREFIX', 'E');

        //Position
        // view()->share('POSITION_TITLE', 'Position');
        view()->share('POSITION_TITLE', 'Position 职位');
        view()->share('POSITION_PREFIX', 'L');

        //Dept
        // view()->share('DEPT_TITLE', 'Department');
        view()->share('DEPT_TITLE', 'Department 部门');
        view()->share('DEPT_PREFIX', 'D');

        //Dept
        // view()->share('PAYSLIP_TITLE', 'Payslip');
        view()->share('PAYSLIP_TITLE', 'Payslip 薪水单');
        view()->share('PAYSLIP_PREFIX', 'P');

        //User
        // view()->share('USER_TITLE', 'User');
        view()->share('USER_TITLE', 'Setting 设置');
        view()->share('USER_PREFIX', 'U');

        //Transaction
        view()->share('TRANS_TITLE', 'Transaction');
        view()->share('TRANS_PREFIX', 'T');

        //Scheduler
        view()->share('SCHEDULER_TITLE', 'Todo\'s');
        view()->share('SCHEDULER_PREFIX', 'T');

        //Market
        view()->share('REPORT_TITLE', 'Report');
        view()->share('REPORT_PREFIX', 'R');

        //Email
        view()->share('EMAIL_TITLE', 'Contact');
        view()->share('EMAIL_PREFIX', '');

        //Leave
        // view()->share('LEAVE_TITLE', 'Leave');
        view()->share('LEAVE_TITLE', 'Leave 假期');
        view()->share('LEAVE_PREFIX', '');

        // leave management
        view()->share('LEAVE_MNG_TITLE', 'Leave Manager 假期管理');
        view()->share('LEAVE_PREFIX', '');

        //Apply Leave
        view()->share('APPLEAVE_TITLE', 'Apply Leave 请假');
        view()->share('APPLEAVE_PREFIX', '');

        // Flash::error('Your domain and server subscription will be due on 26th February 2017. Please contact +65 9037 2079 to renew subscription.')->important();
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
