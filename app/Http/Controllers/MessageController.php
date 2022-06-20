<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the message.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $nom= Auth::user()->nom;
        $prenom=Auth::user()->prenom;
        $to=$prenom . ' ' . $nom;
       
        $messageQuery = Message::query();
       
        $messageQuery->where('from', 'like', '%'.request('q').'%')->where('to', '=', $to );
        $messages = $messageQuery->paginate(25);

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Message);
        $all_users=User::all();
        
        foreach ($all_users as $user){
            $n=$user->prenom . ' '. $user->nom ;
            $users[$n]= $n;
       
           }
        return view('messages.create',compact('users'));
    }

    /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Message);

        $newMessage = $request->validate([
            'to'        => 'required|max:60',
            'message' => 'nullable|max:255',
        ]);

        $nom= Auth::user()->nom;
        $prenom=Auth::user()->prenom;
        $from=$prenom . ' ' . $nom;
        $newMessage['creator_id'] = auth()->id();
        $newMessage['from'] = $from;

        $message = Message::create($newMessage);

        return redirect()->route('messages.show', $message);
    }

    /**
     * Display the specified message.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\View\View
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified message.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\View\View
     */
    public function edit(Message $message)
    {
        $this->authorize('update', $message);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $messageData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $message->update($messageData);

        return redirect()->route('messages.show', $message);
    }

    /**
     * Remove the specified message from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Message $message)
    {
        $this->authorize('delete', $message);

        $request->validate(['message_id' => 'required']);

        if ($request->get('message_id') == $message->id && $message->delete()) {
            return redirect()->route('messages.index');
        }

        return back();
    }
}
