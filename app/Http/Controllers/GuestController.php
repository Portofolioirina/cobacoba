<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$guests = Guest::all();
        $guests = Guest::paginate(10);
        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dump($request->all());
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'email' => 'email|string|max:255',
            'phone_number' => 'string|max:13',

       ]);

       if ($request->hasFile('avatar')) {
        $request->validate([
            'avatar' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('avatar')->storePublicly('public/images');

        $validated['avatar'] = $imagePath;
       }

        Guest::create([
        'name' => $validated['name'],
        'message' => $validated['message'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
        'avatar' => $validated['avatar'] ?? null,
       ]);

       return redirect()->route('guest.index')->with('succes', 'Guest added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'message' => 'required|string|max:255',
        'email' => 'email|string|max:255',
        'phone_number' => 'string|max:13',

        ]);

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            ]);

            $imagePath = $request->file('avatar')->storePublicly('public/images');

            //hapus file existing
            if ($guest->avatar){
                Storage::delete($guest->avatar);
            }

            $validated['avatar'] = $imagePath;
        }

            $guest->update([
                'name' =>$validated['name'],
                'message' =>$validated['message'],
                'email' =>$validated['email'],
                'phone_number' =>$validated['phone_number'],
                'avatar' =>$validated['avatar'] ?? $guest->avatar,
            ]);

        return redirect()->route('guest.index')->with('succes', 'Guest updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        if ($guest->avatar){
            Storage::delete($guest->avatar);
        }
        $guest->delete();
        return redirect()->route('guest.index')->with('succes', 'Guest deleted successfully.');
    }
}
