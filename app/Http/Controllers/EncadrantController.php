<?php

namespace App\Http\Controllers;

use App\Models\Encadrant;
use Illuminate\Http\Request;

class EncadrantController extends Controller
{
    /**
     * Display a listing of the encadrant.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $encadrantQuery = Encadrant::query();
        $encadrantQuery->where('prenom', 'like', '%'.request('q').'%');
        $encadrants = $encadrantQuery->paginate(25);

        return view('encadrants.index', compact('encadrants'));
    }

    /**
     * Show the form for creating a new encadrant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Encadrant);

        return view('encadrants.create');
    }

    /**
     * Store a newly created encadrant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Encadrant);

        $newEncadrant = $request->validate([
            'nom'        => 'required|max:60',
            'prenom' => 'required|max:60',
            'tel'        => 'required|max:60',
            'email'        => 'required|max:60',
            'status'        => 'required|max:60',
        
        ]);
        $newEncadrant['creator_id'] = auth()->id();

        $encadrant = Encadrant::create($newEncadrant);

        return redirect()->route('encadrants.show', $encadrant);
    }

    /**
     * Display the specified encadrant.
     *
     * @param  \App\Models\Encadrant  $encadrant
     * @return \Illuminate\View\View
     */
    public function show(Encadrant $encadrant)
    {
        return view('encadrants.show', compact('encadrant'));
    }

    /**
     * Show the form for editing the specified encadrant.
     *
     * @param  \App\Models\Encadrant  $encadrant
     * @return \Illuminate\View\View
     */
    public function edit(Encadrant $encadrant)
    {
        $this->authorize('update', $encadrant);

        return view('encadrants.edit', compact('encadrant'));
    }

    /**
     * Update the specified encadrant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encadrant  $encadrant
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Encadrant $encadrant)
    {
        $this->authorize('update', $encadrant);

        $encadrantData = $request->validate([
            'nom'        => 'required|max:60',
            'prenom' => 'required|max:60',
            'tel'        => 'required|max:2',
            'email'        => 'required|max:60',
            'status'        => 'required|max:60',
        
        ]);
        $encadrant->update($encadrantData);

        return redirect()->route('encadrants.show', $encadrant);
    }

    /**
     * Remove the specified encadrant from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encadrant  $encadrant
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Encadrant $encadrant)
    {
        $this->authorize('delete', $encadrant);

        $request->validate(['encadrant_id' => 'required']);

        if ($request->get('encadrant_id') == $encadrant->id && $encadrant->delete()) {
            return redirect()->route('encadrants.index');
        }

        return back();
    }
}
