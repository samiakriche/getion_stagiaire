<?php

namespace App\Http\Controllers;

use App\Models\DemandeStage;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeStageController extends Controller
{
    /**
     * Display a listing of the demandeStage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   $user_id = Auth::id();
        $user_role = Auth::user()->role;


        if ($user_role == 'admin') {
            $demandeStageQuery = DemandeStage::query();
            $demandeStageQuery->where('name', 'like', '%'.request('q').'%');
    
        } else {
            $demandeStageQuery = DemandeStage::query();
            $demandeStageQuery->where('name', 'like', '%'.request('q').'%')->where('creator_id', '=', $user_id );
    
        }
        $demandeStages = $demandeStageQuery->paginate(25);

        return view('demande_stages.index', compact('demandeStages'));
    }

    /**
     * Show the form for creating a new demandeStage.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new DemandeStage);

        return view('demande_stages.create');
    }

    /**
     * Store a newly created demandeStage in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
      
        $this->authorize('create', new DemandeStage);
        
     
        
       
 
       
             

       
     

        $newDemandeStage = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
            'file'  => 'required',
            "societe" => 'required',
            "date_debut" => 'required',
            "date_fin" => 'required',
            "description" => 'required',
        
        ]);


        $name_file = $request->file('file')->getClientOriginalName();
        $path_file = $request->file->store('public/files');
        
        $newDemandeStage['creator_id'] = auth()->id();
        $newDemandeStage['name_file'] = $name_file;
        $newDemandeStage['path_file'] = $path_file;
        $newDemandeStage['status'] = "Pending";
        $newDemandeStage['encadrant_id'] = 0;


        
 
       // 
        //dd($path_file);
      //  dd($newDemandeStage);

        $demandeStage = DemandeStage::create($newDemandeStage);

        return redirect()->route('demande_stages.show', $demandeStage);
    }

    /**
     * Display the specified demandeStage.
     *
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return \Illuminate\View\View
     */
    public function show(DemandeStage $demandeStage)
    {
        return view('demande_stages.show', compact('demandeStage'));
    }

    /**
     * Show the form for editing the specified demandeStage.
     *
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return \Illuminate\View\View
     */
    public function edit(DemandeStage $demandeStage)
    {
        $this->authorize('update', $demandeStage);

        return view('demande_stages.edit', compact('demandeStage'));
    }

    /**
     * Update the specified demandeStage in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, DemandeStage $demandeStage)
    {
        $this->authorize('update', $demandeStage);

        $demandeStageData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        dd(  $demandeStage);
        $demandeStage->update($demandeStageData);
        dd(  $demandeStageData);

        return redirect()->route('demande_stages.show', $demandeStage);
    }

    public function status(Request $request, $id)
    {   
      //  $this->authorize('update', $demandeStage);

        $status = $request->input('status');

        $ds = DemandeStage::find($id);
        

        //dd($status);

        if ( $status == 'accepter') {
            $ds->status = 'Accepted';
            $idUser = $ds->creator_id;
            $user=User::find($idUser);

           // $newEtudiant['creator_id'] = auth()->id();
            $newEtudiant['nom'] = $user->nom;
            $newEtudiant['prenom'] = $user->prenom;
            $newEtudiant['email'] = $user->email;
          //  dd($newEtudiant);
            $etudiant = Etudiant::create($newEtudiant);
            
        } else {
            $ds->status = 'Refused';
        }
        
 
        $ds->save();

        return redirect()->route('demande_stages.index');
      
    }

  
    public function encadrant(Request $request, $id)
    {  
         $encadrant_id = $request->input('encadrant_id');
       // dd($request->all());
        $ds = DemandeStage::find($id);
       // dd($ds);
        $ds->encadrant_id= $encadrant_id;
        $ds->save();

        return redirect()->route('demande_stages.index');


    }

    /**
     * Remove the specified demandeStage from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DemandeStage  $demandeStage
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, DemandeStage $demandeStage)
    {
        $this->authorize('delete', $demandeStage);

        $request->validate(['demande_stage_id' => 'required']);

        if ($request->get('demande_stage_id') == $demandeStage->id && $demandeStage->delete()) {
            return redirect()->route('demande_stages.index');
        }

        return back();
    }
}
