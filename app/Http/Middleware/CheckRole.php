<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)//diberi ... karna $roles merupakan array
    {
        if(in_array($request->user()->role,$roles)){// jika role(admin/siswa) sama dengan isi dari $roles(array yang berisi admin dan siswa)
            return $next($request);
        }

        return redirect('/');
    }

    //seteah kita membuat role selanjutnya adalah meregristari middlewar ke kernel.php(app/http)
}
