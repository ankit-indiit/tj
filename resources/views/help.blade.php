@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contents mt-8">
   <div class="container">
      <h1 class="privacy-plicy" style="">Help</h1>
      <div class="main-privcy-cov">
         <h2 style="font-size: 20px;text-align: left">1. LOREM IPSUM</h2>
         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
         </p>
      </div>
      <div class="main-privcy-cov">
         <h2 style="font-size: 20px;text-align: left">2. LOREM IPSUM</h2>
         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
      <div class="main-privcy-cov">
         <h2 style="font-size: 20px;text-align: left">3. LOREM IPSUM</h2>
         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
      <div class="main-privcy-cov">
         <h2 style="font-size: 20px;text-align: left">4.LOREM IPSUM</h2>
         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
   </div>
   <div id="logout-modal" class="create-post uk-modal" uk-modal="">
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
         <div class="text-center py-4 border-b">
            <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2 uk-icon uk-close" type="button" uk-close="" uk-tooltip="title: Close ; pos: bottom ;offset:7" title="" aria-expanded="false">
               <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                  <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                  <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
               </svg>
            </button>
         </div>
         <div class="main-txt">
            <h3 class="text-lg font-semibold"> Are you sure you want to logout? </h3>
            <div class="space-x-2 buttons-yesno">
               <a href="login.html" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium">
               Yes </a>  
               <a href="#" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
               Cancel </a>
            </div>
         </div>
      </div>
   </div>
   
</div>
@endsection