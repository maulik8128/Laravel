<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

                // Gate::define('update-post', function($user, $post){
        //     return $user->id === $post->user_id;
        // });
        // Gate::define('delete-post', function($user, $post){
        //     return $user->id === $post->user_id;
        // });
        // Gate::allows('update-post',$post);
        // Gate::define('posts.update',[Post::class, 'update']);
        // Gate::resource('posts',Post::class);


        // Gate::before(function($user, $ability){
        //     if($user->is_admin && in_array($ability, ['update','delete'])){
        //         return true;
        //     }
        // });
        // Gate::after(function($user,$ability,$result){
        //     if($user->is_admin){
        //         return true;
        //     }
        // });
    }
}
