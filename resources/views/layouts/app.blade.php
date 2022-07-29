<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->

    <!-- Basic Page Needs
        ================================================== -->
    <title>@isset($page_title) {{ $page_title }} @else TJ @endisset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- CSS 
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uikit.css') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('css/emoji.css') }}" />    

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var _baseURL = '{{ url('/') }}';
    </script>
</head>

<body class="no-scroll">
    <div id="wrapper">
        <!-- Header -->
        <header>
            <div class="header_wrap">
                <div class="header_inner mcontainer">
                    <div class="left_side">

                        <span class="slide_menu" uk-toggle="target: #wrapper ; cls: is-collapse is-active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z" fill="currentColor"></path>
                            </svg>
                        </span>

                        <div id="logo">
                            <a href="{{ url('/') }}">
                                <h1 class="logo-here">Logo Here</h1>
                            </a>
                        </div>
                    </div>
                    <!-- search icon for mobile -->

                    <div class="search-box col-md-9">
                        @include('component.header-search')
                    </div>

                    <div class="right_side">
                        <div class="header_widgets">
                            @guest
                            <a href="{{ url('login') }}">
                                <button type="button" class="btn btn-lg" style="font-size: 15px;font-weight: 700;"><i class="fa fa-user-circle" aria-hidden="true"></i>Log In</button>
                            </a>
                            @else
                            <a href="#" class="is_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if (count(userUnreadNotification()) > 0)
                                    <span>{{ count(userUnreadNotification()) }}</span>
                                @endif
                            </a>
                            <div uk-drop="mode: click" class="header_dropdown">
                                <div class="dropdown_scrollbar" data-simplebar>
                                    <div class="drop_headline">
                                        <h4>Notifications </h4>                 
                                    </div>
                                    <ul>
                                        @foreach (userUnreadNotification() as $unReadNotification)
                                            <li>
                                                <a href="#">
                                                    <div class="drop_avatar">
                                                        <img src="{{ show_user_image($unReadNotification->data['data']['sender_id']) }}" alt="">
                                                    </div>
                                                    <div class="drop_text">
                                                        <p>
                                                            {{$unReadNotification->data['data']['body']}}
                                                        </p>
                                                        <time> {{ show_time_ago($unReadNotification->created_at) }} </time>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ route('notification') }}" class="see-all"> See all Notifications </a>
                            </div>
                            <!-- Message -->
                            <a href="#" class="is_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <span>{{count(userMsgNotification())}}</span>
                            </a>
                            <div uk-drop="mode: click" class="header_dropdown is_message">
                                <div class="dropdown_scrollbar" data-simplebar>
                                    <div class="drop_headline">
                                        <h4>Messages </h4>
                                        {{-- <div class="btn_action">
                                            <a href="#">
                                                <i class="icon-feather-settings" uk-tooltip="title: Notifications settings ; pos: left" title="" aria-expanded="false"></i>
                                            </a>
                                            <a href="#">
                                                <i class="icon-feather-settings" uk-tooltip="title: Notifications settings ; pos: left" title="" aria-expanded="false"></i>
                                            </a>
                                        </div> --}}
                                    </div>
                                    <input type="text" class="uk-input" placeholder="Search in Messages">
                                    <ul>
                                        @foreach (userMsgNotification() as $message)
                                        @php
                                            $actionURL = json_decode($message->data)->data->actionURL;
                                            $sender = json_decode($message->data)->data->sender_id;
                                            $msg = json_decode($message->data)->data->body;
                                        @endphp
                                        <li class="un-read">
                                            <a href="{{ $actionURL }}">
                                                <div class="drop_avatar">
                                                    <img src="{{ show_user_image($sender) }}" alt="">
                                                </div>
                                                <div class="drop_text">
                                                    <strong>{{ show_user_name($sender) }}</strong>
                                                    <time>{{date('H:i A', strtotime($message->created_at))}}</time>
                                                    <p>{{ $msg }}</p>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ route('chat') }}" class="see-all"> See all in Messages</a>
                            </div>
                            @if (Auth::user()->switch_as == 'buyer')
                                <a href="{{ route('wishlist') }}" class="is_icon" aria-expanded="false">
                                    <ion-icon name="heart-sharp" class="heart-wish"></ion-icon>
                                    @if (wishlistCount() > 0)
                                        <span>{{ wishlistCount() }}</span>
                                    @endif
                                </a>
                                <a href="{{ route('cart') }}" class="is_icon" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="cart-main">{{ cartCount() }}</span>
                                </a>
                            @endif
                            <a href="#">
                                <img src="{{ show_user_image() }}" class="is_avatar user_profile_image" alt="">
                            </a>
                            <div uk-drop="mode: click;offset:5" class="header_dropdown profile_dropdown">
                                <a href="{{ url('my-profile') }}?tab=feed" class="user">
                                    <div class="user_avatar">
                                        <img class="user_profile_image" src="{{ show_user_image() }}" alt="">
                                    </div>
                                    <div class="user_name">
                                        <div> {{ Auth::user()->name }} </div>
                                    </div>
                                </a>
                                <hr class="border-gray-100">
                                <a href="{{ url('change-password') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd" />
                                    </svg> Change Password
                                </a>
                                <a href="{{ route('privacy-policy') }}">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                    </svg> Settings/ Privacy
                                </a>
                                <a href="{{ route('help') }}">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                    </svg> Help
                                </a>


                                <a href="javascript:void(0);" uk-toggle="target: #logout-modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg> Log Out
                                </a>

                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
        </header>
        <!-- Header -->
        @auth
        @include('layouts.includes.becomeaseller')
        @endauth

        @auth
            @if (Auth::user()->switch_as == 'seller')
                @include('layouts.includes.sidebar.seller-sidebar')
            @else
                @include('layouts.includes.sidebar.buyer-sidebar')
            @endif        
        @endauth

        @yield('content')


    </div>

    @yield('customModals')

    @auth
    <div id="logout-modal" class="create-post" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
            <div class="text-center py-4 border-b">
                <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
            </div>
            <div class="main-txt">
                <h3 class="text-lg font-semibold">Are you sure you want to logout?</h3>
                <div class="space-x-2 buttons-yesno">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium"> Yes </a>
                    <a href="javascript:void(0);" onclick="$('#logout-modal').removeClass('uk-open').hide();" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm"> Cancel </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    @endauth
</body>
<!-- Javascript
    ================================================== -->
<!--script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}" ></script---->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!---script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script-->
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script src="{{ asset('js/uikit.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>


<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@yield('customScripts')
<!-- Begin emoji-picker JavaScript -->
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/jquery.emojiarea.js') }}"></script>
<script src="{{ asset('js/emoji-picker.js') }}"></script>
<!-- End emoji-picker JavaScript -->
<script>
   $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: '{{ asset("/") }}/images',
            popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();

    }); 
    $().ready(function() {
        //$('#myTab li:last-child a').tab('show');

        $('#auctions').click(function() {
            $('.sidebarbox').slideToggle(400);
        });
    })
</script>
<script src="{{ asset('js/custom-scripts.js') }}"></script>
<script src="{{ asset('js/custom-cart.js') }}"></script>
<script src="{{ asset('js/custom-message.js') }}"></script>
@if (\Session::has('success'))
    <script type="text/javascript">
        swal("", "{{ \Session::get('success') }}", "", {
            button: "close",
        });
    </script>    
@endif

@if (\Session::has('error'))
    <script type="text/javascript">
        swal("", "{{ \Session::get('error') }}", "", {
            button: "close",
        });
    </script>    
@endif

</html>