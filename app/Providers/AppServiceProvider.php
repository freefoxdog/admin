<?php

namespace App\Providers;

use App\Observers\AdminUsersObserver;
use App\Storage\Database\AdminUser;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Response::macro('apiReturn',function($content, $code = 0, $codeDesc = '', $httpStatus = 200){


            $data = [
                'statusCode'=>$code,
                'statusDesc'=>$codeDesc,
                'data'=>$content,
            ];

            return   response($data, $httpStatus) ;
        });

        AdminUser::observe(AdminUsersObserver::class);


        Paginator::defaultView('vendor.pagination.default');
        DB::listen(function($query){
            Log:info($query->sql);
        });




    }
}
