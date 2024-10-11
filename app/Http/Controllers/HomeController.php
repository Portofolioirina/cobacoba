<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $guest_name = 'Irina';
        return view('home', compact('guest_name'));
    }

    public function getGuest($id, $serial_number = -1)
    {

        return view('guest-detail', compact('id','serial_number'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:10'
        ]);
        return $request->name;
    }

}
