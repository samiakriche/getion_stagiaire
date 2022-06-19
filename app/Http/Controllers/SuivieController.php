<?php

namespace App\Http\Controllers;

use App\Models\Suivie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DemandeStage;


class SuivieController extends Controller
{
    /**
     * Display a listing of the suivie.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $user_id = Auth::id();
        $user_role = Auth::user()->role;


        if ($user_role == 'admin') {
            $suivieQuery = Suivie::query();
            $suivieQuery->where('titre_stage', 'like', '%'.request('q').'%');
    
        } elseif ($user_role == 'encadrant'){
            $suivieQuery = Suivie::query();
            $suivieQuery->where('titre_stage', 'like', '%'.request('q').'%')->where('creator_id', '=', $user_id );
    
        }
        else{

            $ds=DemandeStage::where('creator_id','=', $user_id );
            $titre_stage=$ds->name;
            $suivieQuery = Suivie::query();
            $suivieQuery->where('titre_stage', 'like', '%'.request('q').'%')->where('titre_stage', '=', $titre_stage );

        }
      
       
        $suivies = $suivieQuery->paginate(25);

        return view('suivies.index', compact('suivies'));
    }

    /**
     * Show the form for creating a new suivie.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Suivie);

        $stages=DemandeStage::all();
        
        foreach ($stages as $stage){
            $n=$stage->name;
            $titre_stages[$n]= $n;
       
           }
        return view('suivies.create',compact('titre_stages'));
    }

    /**
     * Store a newly created suivie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Suivie);

        $newSuivie = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newSuivie['creator_id'] = auth()->id();

        $suivie = Suivie::create($newSuivie);

        return redirect()->route('suivies.show', $suivie);
    }

    /**
     * Display the specified suivie.
     *
     * @param  \App\Models\Suivie  $suivie
     * @return \Illuminate\View\View
     */
    public function show(Suivie $suivie)
    {
        return view('suivies.show', compact('suivie'));
    }

    /**
     * Show the form for editing the specified suivie.
     *
     * @param  \App\Models\Suivie  $suivie
     * @return \Illuminate\View\View
     */
    public function edit(Suivie $suivie)
    {
        $this->authorize('update', $suivie);

        return view('suivies.edit', compact('suivie'));
    }

    /**
     * Update the specified suivie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suivie  $suivie
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Suivie $suivie)
    {
        $this->authorize('update', $suivie);

        $suivieData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $suivie->update($suivieData);

        return redirect()->route('suivies.show', $suivie);
    }

    /**
     * Remove the specified suivie from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suivie  $suivie
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Suivie $suivie)
    {
        $this->authorize('delete', $suivie);

        $request->validate(['suivie_id' => 'required']);

        if ($request->get('suivie_id') == $suivie->id && $suivie->delete()) {
            return redirect()->route('suivies.index');
        }

        return back();
    }
}
