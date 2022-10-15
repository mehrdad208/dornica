<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

                /* define a admin user role */

                Gate::define('isAdmin', function($user) {

                    return $user->user_type == 1;
         
                 });
         
                
         
                 /* define a manager user role */
         
                 Gate::define('isManager', function($user) {
         
                     return $user->user_type == 2;
         
                 });
         
               
         
                 /* define a user role */
         
                 Gate::define('isUser', function($user) {
         
                     return $user->user_type == 0;
         
                 });
    }
}
// @extends('layouts.app')

  

// @section('content')

// <div class="container">

//     <div class="row justify-content-center">

//         <div class="col-md-8">

//             <div class="card">

//                 <div class="card-header">Dashboard</div>

   

//                 <div class="card-body">

//                     @if (session('status'))

//                         <div class="alert alert-success" role="alert">

//                             {{ session('status') }}

//                         </div>

//                     @endif

  

//                     @can('isAdmin')

//                         <div class="btn btn-success btn-lg">

//                           You have Admin Access

//                         </div>

//                     @elsecan('isManager')

//                         <div class="btn btn-primary btn-lg">

//                           You have Manager Access

//                         </div>

//                     @else

//                         <div class="btn btn-info btn-lg">

//                           You have User Access

//                         </div>

//                     @endcan

  

//                 </div>

//             </div>

//         </div>

//     </div>

// </div>

// @endsection