<?php

namespace App\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;
use Livewire\Attributes\On;

use Livewire\Component;

class Friends extends Component
{
    public $users = null;

    public function mount()
    {
        $this->users = User::where('id','!=',Auth::id())->get();

    }

    #[On('save')]
    public function save($userId)
    {
       
        $user = User::find($userId);
        $conversation = Conversation::where('sender_id', Auth::id())
            ->where('receiver_id', $userId)
            ->orWhere('receiver_id', Auth::id())
            ->where('sender_id', $userId)->first();
        
        if($user && !$conversation) {
            $conversation = Conversation::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $userId,
            ]);
            Message::create([
                'message' => 'Hello',
                'conversation_id' => $conversation->id,
                'sender_id' => Auth::id(),
                'receiver_id' => $userId,
            ]);
        }
    }
    public function render()
    {
        return view('livewire.friends');
    }
}
