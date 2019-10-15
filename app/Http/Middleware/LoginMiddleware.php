<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check()){
             $user = User::find(\Auth::user()->id);
             $check=1;
                foreach ($user->infringes as $key => $value) {
                    if($value->status==2){
                        $check = 2;
                        break;
                    }
                }
                if($check==1){
                    return $next($request);
                }else{
                    return redirect()->route('formLogin')->with('errorK','Tài khoản của bạn đã bị khóa vì đã vi phạm quy định!');
                }
        }else{
            return redirect()->route('formLogin')->with('path',$request->path());
        }
    }
}
