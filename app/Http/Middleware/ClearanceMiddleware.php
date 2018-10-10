<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){        
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
    {
            return $next($request);
        }

        if ($request->is('categories/create'))//If user is creating a category
         {
            if (!Auth::user()->hasPermissionTo('Create Category'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('categories/*/edit')) //If user is editing a category
        {
           if (!Auth::user()->hasPermissionTo('Edit Category')) {
               abort('401');
           } else {
               return $next($request);
           }
       }

       if ($request->isMethod('Delete')) //If user is deleting a category
         {
            if (!Auth::user()->hasPermissionTo('Delete Category')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }


        if ($request->is('books/create')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('Create Book')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('books/*/edit')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('Edit Book')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        

        if ($request->isMethod('Delete')) //If user is deleting a post
         {
            if (!Auth::user()->hasPermissionTo('Delete Book')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }

        return $next($request);
    
        if ($request->is('posts/create'))//If user is creating a post
        {
           if (!Auth::user()->hasPermissionTo('Create Category'))
        {
               abort('401');
           } 
        else {
               return $next($request);
           }
       }
    
    }

    
}