<div >

    @if($messages && $receiver)

    <div class="headerMessages">
        <div class="profilMessage">
            <span class="logo">
                @if($receiver->image)
                <img src="{{asset('storage/'.$receiver->image)}}" alt="logo"></span>
                 @else
               <img src="{{asset('storage/logo.png')}}" alt="logo"></span>
                 @endif
            </span>
            
            <span class="profilName">{{ $receiver->name }}</span>
            
            
        </div>
    </div>

    <div class="bodyMessages" id="bodyMessages">

        @foreach ($messages as $message )

            @if($message['sender_id'] == $user->id)

               <div class="sender">
                   <div class="message">
                       <div class="message">{{$message['message']}}</div>
                       <span class="date text-slate-500">{{ \Carbon\Carbon::parse($message['created_at'])->format('D d h:i A') }}</span>
                   </div>
                   <span class="logo">
                        @if($user->image)
                          <img src="{{asset('storage/'.$user->image)}}" alt="logo"></span>
                        @else
                          <img src="{{asset('storage/logo.png')}}" alt="logo"></span>
                        @endif
                </span>
               </div>

            @elseif($receiver && $message['sender_id'] == $receiver->id)

            <div class="recever">
                <span class="logo">
                    @if($receiver->image)
                     <img src="{{asset('storage/'.$receiver->image)}}" alt="logo"></span>
                    @else
                     <img src="{{asset('storage/logo.png')}}" alt="logo"></span>
                    @endif
                </span>
                <div class="message">
                    <div class="message">{{$message['message']}}</div>
                    <span class="date text-slate-500">{{ \Carbon\Carbon::parse($message['created_at'])->format('M d h:i A') }}</span>
                </div>
            </div>

            @endif

        @endforeach

      
    </div>

 
               @script       
                      <script>
                        setTimeout(function(){ 
                 
                          console.log('hello');
                          let contaner = document.querySelector('#bodyMessages');
                             if (contaner) {

                                 contaner.onscroll = function() {
                                    // console.log(contaner.scrollTop);
                                    if(contaner.scrollTop == 0  )
                                      {
                                        $wire.dispatch('loadMoreMessages');
                                      }
                                 }
                                
                             } else {
                                 console.error('bodyMessages element not found');
                             }

                             
                        }, 0.1);

                             window.addEventListener('pushMasseg', () => {
                                setTimeout(function(){ 
                 
                                      console.log('hello');
                                      let contaner = document.querySelector('#bodyMessages');
                                         if (contaner) {
                                             contaner.scrollTop = contaner.scrollHeight ;
                                             $wire.dispatch('scrollHeight',[contaner.scrollHeight]);
                                         } else {
                                             console.error('bodyMessages element not found');
                                         }
                                }, 0.1);
                              });

                              window.addEventListener('loadScroll', (event) => {
                                setTimeout(function(){ 
                 
                                    // alert('loadScroll event triggered');
                                   let contaner = document.querySelector('#bodyMessages');
                                   let height = contaner.scrollTop = contaner.scrollHeight - event.detail[0][0] ;
                                   
                                    console.log(contaner.scrollHeight ,'ggg', event.detail[0][0]);
                                    $wire.dispatch('scrollHeight',[contaner.scrollHeight]);
                                },0.1);
                              });
                             
                       </script>

                @endscript
    @else

    <p  class="emty_message">No messages</p>
@endif

</div>






     
          





