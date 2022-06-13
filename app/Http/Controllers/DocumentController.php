<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the document.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documentQuery = Document::query();
        $documentQuery->where('nom', 'like', '%'.request('q').'%');
        $documents = $documentQuery->paginate(25);

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Document);

        return view('documents.create');
    }

    /**
     * Store a newly created document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
      //  $this->authorize('create', new Document);
        $newDocument = $request->validate([
            
            'description' => 'nullable|max:255',
            'file'  => 'required',
        
        ]);
      
       // $newdocument['name'] = 'file';
        //$newdocument['name'] = $request->file('file')->getClientOriginalName();
        $newDocument['creator_id'] = auth()->id();
        $newDocument['nom'] = $request->file('file')->getClientOriginalName();

        //dd($request->file);

      
       // dd($newdocument['name'] );
        //$path_file = $request->file->store('public/files');
        
        $request->file->storeAs('public/files',  $newDocument['nom'] );


       
        $document = Document::create($newDocument);

        return redirect()->route('documents.show', $document);
    
    
    }


    public function download( $id)
{

    $document = Document::where('id', $id)->firstOrFail();
    $pathToFile = storage_path('app/public/files/' . $document->nom);
    //dd($pathToFile);
    return response()->download($pathToFile);

}
    /**
     * Display the specified document.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\View\View
     */
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified document.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\View\View
     */
    public function edit(Document $document)
    {
        $this->authorize('update', $document);

        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize('update', $document);

        $documentData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $document->update($documentData);

        return redirect()->route('documents.show', $document);
    }

    /**
     * Remove the specified document from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Document $document)
    {
        $this->authorize('delete', $document);

        $request->validate(['document_id' => 'required']);

        if ($request->get('document_id') == $document->id && $document->delete()) {
            return redirect()->route('documents.index');
        }

        return back();
    }
}
