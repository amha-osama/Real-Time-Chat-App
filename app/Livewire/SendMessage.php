<?php

namespace App\Livewire;

use App\Events\NewMessage;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class SendMessage extends Component
{
    public $message = '';
    public $count = 0;
    public $receiverId;
    public $conversation_id;


    #[On('getSendMessages')]
    public function getSendMessages($arr =[])
    {
        $this->receiverId =$arr['receiver_id'];
        $this->conversation_id = $arr['conversation_id'];
        
    }

    public function save()
    {
        if ( trim($this->message) == '' || !$this->receiverId || !$this->conversation_id) {
            return;
        }

        $message = Message::create([
            'message' => $this->message,
            'conversation_id' => $this->conversation_id,
            'sender_id' => Auth::id(),
            'receiver_id' => $this->receiverId,
        ]);

        $this->dispatch('pushMessage', $message->id)->to(BoxChatMessages::class);
      
        $this->message = '';

        broadcast(new NewMessage($message->id, $this->receiverId));

    }
    public function render()
    {
        return view('livewire.send-message');
    }
}
