<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the enseignant.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $enseignantQuery = Enseignant::query();
        $enseignantQuery->where('name', 'like', '%'.request('q').'%');
        $enseignants = $enseignantQuery->paginate(25);

        return view('enseignants.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new enseignant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Enseignant);

        return view('enseignants.create');
    }

    /**
     * Store a newly created enseignant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Enseignant);

        $newEnseignant = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newEnseignant['creator_id'] = auth()->id();

        $enseignant = Enseignant::create($newEnseignant);

        return redirect()->route('enseignants.show', $enseignant);
    }

    /**
     * Display the specified enseignant.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\View\View
     */
    public function show(Enseignant $enseignant)
    {
        return view('enseignants.show', compact('enseignant'));
    }

    /**
     * Show the form for editing the specified enseignant.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\View\View
     */
    public function edit(Enseignant $enseignant)
    {
        $this->authorize('update', $enseignant);

        return view('enseignants.edit', compact('enseignant'));
    }

    /**
     * Update the specified enseignant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Enseignant $enseignant)
    {
        $this->authorize('update', $enseignant);

        $enseignantData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $enseignant->update($enseignantData);

        return redirect()->route('enseignants.show', $enseignant);
    }

    /**
     * Remove the specified enseignant from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Enseignant $enseignant)
    {
        $this->authorize('delete', $enseignant);

        $request->validate(['enseignant_id' => 'required']);

        if ($request->get('enseignant_id') == $enseignant->id && $enseignant->delete()) {
            return redirect()->route('enseignants.index');
        }

        return back();
    }
}
