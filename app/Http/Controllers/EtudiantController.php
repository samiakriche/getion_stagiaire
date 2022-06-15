<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the etudiant.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $etudiantQuery = Etudiant::query();
        $etudiantQuery->where('nom', 'like', '%'.request('q').'%');
        $etudiants = $etudiantQuery->paginate(25);

        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new etudiant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Etudiant);

        return view('etudiants.create');
    }

    /**
     * Store a newly created etudiant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Etudiant);

        $newEtudiant = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newEtudiant['creator_id'] = auth()->id();

        $etudiant = Etudiant::create($newEtudiant);

        return redirect()->route('etudiants.show', $etudiant);
    }

    /**
     * Display the specified etudiant.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\View\View
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified etudiant.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\View\View
     */
    public function edit(Etudiant $etudiant)
    {
        $this->authorize('update', $etudiant);

        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Update the specified etudiant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $this->authorize('update', $etudiant);

        $etudiantData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $etudiant->update($etudiantData);

        return redirect()->route('etudiants.show', $etudiant);
    }

    /**
     * Remove the specified etudiant from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Etudiant $etudiant)
    {
        $this->authorize('delete', $etudiant);

        $request->validate(['etudiant_id' => 'required']);

        if ($request->get('etudiant_id') == $etudiant->id && $etudiant->delete()) {
            return redirect()->route('etudiants.index');
        }

        return back();
    }
}
