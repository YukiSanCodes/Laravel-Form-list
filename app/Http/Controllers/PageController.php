<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $data = [
            'course' => "IT0045",
            'module' => "Laravel Foundations",
        ];

        return view('about', $data);
    }

    public function task($id)
    {
        $data = [
            'id' => $id,
            'title' => "Julian Fave Meal Sinigang",
        ];

        return view('task', $data);
    }
}