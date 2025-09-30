<?php

namespace App\Http\Controllers;

use App\Models\univers;
use App\Models\Univers as ModelsUnivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Univers::all();
        return view('univers.index' , compact('list'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = "creation";
        return view("univers.creation" , compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'description' => 'required|min:3',
            'img_fond' => 'required|min:6',
            'logo' => 'required|min:6',
            'couleur_principal' => 'required|min:6',
            'couleur_secondaire' => 'required|min:6',
        ]);

        $pathfond = $request->file('img_fond')->store('image', 'public');
        $path = $request->file('logo')->store('image', 'public');

        Univers::create([
            'nom' => $request["nom"],
            'description' => $request['description'],
            'img_fond' => $pathfond,
            'logo' => $path,
            'couleur_principal' => $request['couleur_principal'],
            'couleur_secondaire' => $request['couleur_secondaire'],
    ]);
        return redirect('/')->with('success', 'univers créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(univers $univers)
    {
        //
        return view("univers.showUnivers", compact('univers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(univers $univers)
    {
        return view("univers.edit", compact('univers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, univers $univers)
    {
        $pathfond = $univers->img_fond;
        $path = $univers->logo;
        if ($request->file('img_fond')!=null):
            Storage::disk('public')->delete($pathfond);
            $pathfond = $request->file('img_fond')->store('image', 'public');
        endif;
        if ($request->file('logo')!=null):
            Storage::disk('public')->delete($path);
            $path = $request->file('logo')->store('image', 'public');
        endif;

        Univers::where('id' , $univers->id)->first()->update([
            'nom' => $request["nom"],
            'description' => $request['description'],
            'img_fond' => $pathfond,
            'logo' => $path,
            'couleur_principal' => $request['couleur_principal'],
            'couleur_secondaire' => $request['couleur_secondaire'],
        ]);
        return redirect('/')->with('success', 'univers créé avec succès !');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(univers $univers)
    {
        //
        // dd($univers);
        $pathfond = $univers->img_fond;
        $path = $univers->logo;
        Storage::disk('public')->delete($pathfond);
        Storage::disk('public')->delete($path);

        Univers::where('id', $univers->id)->delete();
         return redirect('/')->with('success', 'univers supprimée avec succès !');
        }
    }
