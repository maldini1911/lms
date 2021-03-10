<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get_profile()
    {
        User::create(['name'  => 'user lms', 'email' => 'user@test.com',
          'password'  => bcrypt('20203030'),'role' => 'admin'
        ]);

        return back();
    }
}
