<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversEditRequest;
use App\Http\Requests\UniversRequest;
use App\Models\Univers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UniversController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware()
    {
        return [new Middleware('admin', ['destroy'])];
    }

    public function index(): View
    {
        $list = Univers::all();

        return view('univers.index', compact('list'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $type = 'add';

        return view('univers.modelUnivers', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversRequest $request): RedirectResponse
    {

        $pathfond = $request->file('img_fond')->store('image', 'public');
        $path = $request->file('logo')->store('image', 'public');

        Univers::create([
            'nom' => $request['nom'],
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
    public function show(univers $univers): View
    {
        //
        return view('univers.showUnivers', compact('univers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(univers $univers): View
    {
        $type = 'edit';

        return view('univers.modelUnivers', compact('univers'), compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UniversEditRequest $request, univers $univers): RedirectResponse
    {
        $pathfond = $univers->img_fond;
        $path = $univers->logo;
        if ($request->file('img_fond') != null) {
            Storage::disk('public')->delete($pathfond);
            $pathfond = $request->file('img_fond')->store('image', 'public');
        }
        if ($request->file('logo') != null) {
            Storage::disk('public')->delete($path);
            $path = $request->file('logo')->store('image', 'public');
        }

        Univers::where('id', $univers->id)->first()->update([
            'nom' => $request['nom'],
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
    public function destroy(univers $univers): RedirectResponse
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
