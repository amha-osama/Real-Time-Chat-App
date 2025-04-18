<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class BoxChatMessages extends Component
{

    
    public array $messages = [];
    public  $receiver;
    public  $receiver_id = 0;
    public int $count = 10;
    public $heightScroll = 690;
    public $conversation_id;
    public User $user;


    public function getListeners()
    {
        $id = Auth::id();
        return [
            "echo-private:chat.{$id},NewMessage" => 'notifyShipped',
        ];
    }

    public function mount()
    {
        $this->user = Auth::user() ? Auth::user() : new User();
       
    }
    public function notifyShipped($event)
    {
       $this->pushMessage($event['message_id']);
    }

    #[On('getMessagesss')]
    public function getMessagesss($arr = [])
    {

       
        $this->receiver = User::find($arr['receiver_id']);
        $this->conversation_id = $arr['conversation_id'];
        $this->receiver_id = $arr['receiver_id'];

        $this->messages = Message::where('conversation_id', $arr['conversation_id'])
            ->orderBy('created_at', 'desc')
            ->take($this->count)
            ->get()
            ->reverse()
            ->toArray();


            Message::where('conversation_id', $arr['conversation_id'])
            ->where('receiver_id', Auth::id())
            ->update(['is_read' => true]);

            $this->dispatch('pushMasseg');
    }

   

    #[On("loadMoreMessages")]
    public function loadMoreMessages()
    {
        $this->count += 10;
        $this->messages = Message::where('conversation_id', $this->conversation_id)
            ->orderBy('created_at', 'desc')
            ->take($this->count)
            ->get()
            ->reverse()
            ->toArray();

        $this->dispatch('loadScroll',[$this->heightScroll]);
 
    }

    #[On("pushMessage")]
    public function pushMessage($message_id)
    {

        $message = Message::find($message_id);
        

        if ($message) {
            $this->messages[] = $message->toArray();
        }

        $this->dispatch('refreshEdit')->to(ChatConversation::class);
        $this->dispatch('pushMasseg');

    }

    
    #[On("scrollHeight")]
    public function scrollHeight($height)
    {  
         $this->heightScroll = $height;
    }

    public function render()
    {
        return view('livewire.box-chat-messages');
    }
}
