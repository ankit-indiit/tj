@php $userId= Crypt::encrypt($receiverId); @endphp 
<a href="{{ route('time.line', $userId) }}" class="flex hover:text-blue-400 items-center leading-8 space-x-2 text-blue-500 font-medium go-profile-btn"> 
  <span class="lg:block hidden"><i class="fa fa-angle-double-left" aria-hidden="true"></i>
  Go to profile </span> 
  </a>
  <div class="px-5 py-4 flex uk-flex-between">
     <a href="{{ route('time.line', $userId) }}" class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-full relative flex-shrink-0">
           <img src="{{ show_user_image($receiverId) }}" alt="" class="h-full rounded-full w-full">
           <span class="absolute bg-green-500 border-2 border-white bottom-0 h-3 m-0.5 right-0 rounded-full shadow-md w-3"></span>
        </div>
        <div class="flex-1 min-w-0 relative text-gray-500">
           <h4 class="font-semibold text-black text-lg">{{ show_user_name($receiverId) }}</h4>
           <p class="font-semibold leading-3 text-green-500 text-sm">is online</p>
        </div>
     </a>
     <a href="javascript:void(0);" id="deleteConversation" data-id="{{ $receiverId }}" class="flex hover:text-red-400 items-center leading-8 space-x-2 text-red-500 font-medium"> 
      <i class="uil-trash-alt"></i> <span class="lg:block hidden"> Delete Conversation </span> 
     </a>
  </div>
  <div class="border-t dark:border-gray-600">
     <div class="lg:p-8 p-4 space-y-5 chatContent">
        <!-- my message-->
        @foreach ($userchat as $chat)
          @if ($chat->from_id == Auth::user()->id)
            <div class="newMessage">              
              <div class="flex lg:items-center flex-row-reverse">
                {{-- <div class="w-14 h-14 rounded-full relative flex-shrink-0">
                    <img src="{{ show_user_image(Auth::user()->id) }}" alt="" class="absolute h-full rounded-full w-full">
                </div> --}}
                @if ($chat->type == 1)
                  <div class="text-white py-2 px-3 rounded bg-blue-600 relative h-full lg:mr-5 mr-2 lg:ml-20">
                      <p class="leading-6">{{ $chat->chat }}</p>
                      <div class="absolute w-3 h-3 top-3 -right-1 bg-blue-600 transform rotate-45"></div>
                  </div>
                @else
                  <div class="text-white py-2 px-3 rounded bg-blue-600 relative h-full lg:mr-5 mr-2 lg:ml-20 w-50">
                      <img src="{{ url('public/images/chat') }}/{{ $chat->chat }}" class="">
                      <div class="absolute w-3 h-3 top-3 -right-1 bg-blue-600 transform rotate-45"></div>
                  </div>
                @endif
              </div>            
            </div>
          @else            
            <div class="flex lg:items-center">
              <div class="w-14 h-14 rounded-full relative flex-shrink-0">
                  <img src="{{ show_user_image($chat->from_id) }}" alt="" class="absolute h-full rounded-full w-full">
              </div>              
              @if ($chat->type == 1)
                <div class="text-gray-700 py-2 px-3 rounded bg-gray-100 h-full relative lg:ml-5 ml-2 lg:mr-20 dark:bg-gray-700 dark:text-white">
                  <p class="leading-6">{{ $chat->chat }}</p>
                  <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-700"></div>
                </div>
              @else
                <div class="text-gray-700 py-2 px-3 rounded bg-gray-100 h-full relative lg:ml-5 ml-2 lg:mr-20 dark:bg-gray-700 dark:text-white w-50">
                  <img src="{{ url('public/images/chat') }}/{{ $chat->chat }}" class="">
                  <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-700"></div>
              </div>
              @endif
            </div>
          @endif
        @endforeach
        <div class="w-25 border d-none" id="privewFileSec">
          <a href="javascript:void(0);" id="removeFile">
            <i class="fa fa-remove"></i>
          </a>
          <img src="" id="privewFile">
        </div>
     </div>
      <form enctype="multipart/form-data" id="sendMessage" method="post">
        @csrf
        <input type="hidden" name="to" id="userId" value="{{ $receiverId }}">
        <input type="hidden" name="from" value="{{ Auth::user()->id }}">
        <input type="file" class="d-none" id="sendFile" name="file" accept="">
        <div class="border-t flex p-6 dark:border-gray-700 main-c">
          <div class="main-icon">
            <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" onclick="ChooseFile('image');" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>                
            </svg>
            <svg class="text-pink-600 h-9 p-1.5 rounded-full bg-pink-100 w-9 cursor-pointer" onclick="ChooseFile('video');" id="veiw-more" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="false" style="">              
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <svg class="text-purple-600 h-9 p-1.5 rounded-full bg-purple-100 w-9 cursor-pointer" onclick="ChooseFile('audio');" id="veiw-more" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="false" style="">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
            </svg>
             <!-- view more -->
            <svg class="hover:bg-gray-200 h-9 p-1.5 rounded-full w-9 cursor-pointer   " id="veiw-more" uk-toggle="target: #veiw-more; animation: uk-animation-fade" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" hidden="" aria-hidden="true" style="">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"> </path>
            </svg>
          </div>
          <textarea cols="1" rows="1" name="message" id="message" placeholder="Your Message.." class="border-0 flex-1 h-10 min-h-0 resize-none min-w-0 shadow-none dark:bg-transparent"></textarea>
          <div class="flex h-full space-x-2">
             <button type="submit" id="sendMessageBtn" onclick="sendMessage();" class="bg-blue-600 font-semibold px-6 py-2 rounded-md text-white">Send</button>
          </div>
        </div>          
    </form>
  </div>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"> 
  function sendMessage(){
    $("#sendMessage").validate({
        rules: {
           message: {
              required: function(){
                if ($('#sendFile').val()) {
                  return false;
                } else {
                  return true;
                }
              }
           }      
        },
        messages: {
           message: "Type your message.."         
        },
        submitHandler: function(form, e) {
          var userId = $('#userId').val();
          var form = $('#sendMessage')[0];
          var serializedData = new FormData(form);
           $('#sendMessageBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
           $.ajax({
              headers: {
                 'X-CSRF-Token': $('input[name="_token"]').val()
              },
              type: 'post',
              enctype: 'multipart/form-data',
              url: "{{ url('send-message') }}",
              data: serializedData,
              dataType: 'json',
              processData: false,
              contentType: false,
              cache: false,
              success: function(data) {
                 $('#sendMessageBtn').html('Send');
                 if (data.erro == '101') {                                    
                    $("#sendMessage").trigger('reset');
                    let lastMsg = '<div class="newMessage"><div class="flex lg:items-center flex-row-reverse"><div class="text-white py-2 px-3 rounded bg-blue-600 relative h-full lg:mr-5 mr-2 lg:ml-20"><p class="leading-6">'+data.message+'</p><div class="absolute w-3 h-3 top-3 -right-1 bg-blue-600 transform rotate-45"></div></div></div></div>';
                    $('.chatContent').append(lastMsg);
                    // userThread(userId);
                 }            
              }
           });
           return false;
        }
    });
  }  

   function ChooseFile(file){
      if (file == 'image') {
        $('#sendFile').attr('accept', 'image/*');
      } else if (file == 'video') {
        $('#sendFile').attr('accept', 'video/*');
      } else if (file == 'audio') {
        $('#sendFile').attr('accept', 'audio/*');
      }
      $('#sendFile').trigger('click');
      // sendMessage();
   }

  sendFile.onchange = evt => {
    $('#privewFileSec').removeClass('d-none');
    const [file] = sendFile.files
    if (file) {
      privewFile.src = URL.createObjectURL(file);
    }
  }

  // $(document).on('click', '#removeFile', function(){
  //   privewFile.src = URL.createObjectURL(#);
  // })
</script>
