<div class="usersContianer">

       @if($users)
        @foreach($users as $user)
        <div class="user"  >
            <div class="profial">
                <span class="logo">
                     @if($user->image)
                         <img src="{{asset('storage/'.$user->image)}}" alt="logo"></span>
                      @else
                         <img src="{{asset('storage/logo.png')}}" alt="logo"></span>
                      @endif
                </span>
                <span class="name">{{$user->name}}</span>
            </div>
           <!-- From Uiverse.io by dissojak --> 
            <button class="bookmarkBtn" wire:click="$dispatch('save', [{{$user->id}}])">
                <span class="IconContainer">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    version="1.1"
                    height="20px"
                    class="icon"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="212"
                    x="0"
                    y="0"
                    viewBox="0 0 24 24"
                    style="enable-background:new 0 0 512 512"
                    xml:space="preserve"
                  >
                    <g>
                      <g data-name="Layer 2">
                        <path
                          d="M13 17.62a5.29 5.29 0 0 0 .38 2l.06.14H3.5a2.25 2.25 0 0 1-2.25-2.26V17A6.71 6.71 0 0 1 4 11.55a6.7 6.7 0 0 0 8.92 0 6.7 6.7 0 0 1 1.87 2.06A5.24 5.24 0 0 0 13 17.62z"
                          fill="#000000"
                          opacity="1"
                          data-original="#000000"
                          class=""
                        ></path>
                        <circle
                          cx="8.5"
                          cy="6.5"
                          r="5.25"
                          fill="#000000"
                          opacity="1"
                          data-original="#000000"
                          class=""
                        ></circle>
                        <path
                          d="M18.38 13.25A4.37 4.37 0 0 0 14 17.62a4.53 4.53 0 0 0 .3 1.62 4.38 4.38 0 1 0 4.08-6zm1.84 5.07h-1.15v1.15a.7.7 0 0 1-1.39 0v-1.15h-1.15a.7.7 0 0 1 0-1.39h1.15v-1.15a.7.7 0 0 1 1.39 0v1.15h1.15a.7.7 0 0 1 0 1.39z"
                          fill="#000000"
                          opacity="1"
                          data-original="#000000"
                          class=""
                        ></path>
                      </g>
                    </g>
                  </svg>
                </span>
                <p class="text">follow</p>
            </button>
  
  
        </div>
        @endforeach
       @else
     
      <p>  no users </p>
      @endif
     
    </div>
    
