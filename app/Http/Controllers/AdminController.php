<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSlider;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function frontpage()
    {
        $sliders = AppSlider::all();
        return view('index', compact('sliders'));
    }
}
