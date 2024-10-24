<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Banner\Models\Banner;

class FrontController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();
        return view('Front::index', compact('banners'));
    }
}
