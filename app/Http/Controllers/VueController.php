<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    public function redirectToFolder()
    {
        return redirect('frontend-app.index');
    }
}
