{{-- @extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

{{-- <form action="{{ route('create-post') }}" method="post">
        @csrf
        <?php $auth = Auth::user()->id; ?>
        <input type="hidden" id="" name="user_id" value="{{ $auth }}"><br>
        <label for="title">Enter Post:</label><br>
        <input type="text" id="title" name="title" value="" placeholder="Post..">
        <input type="submit" value="Submit">
    </form> --}}
<post-component>
</post-component>
{{-- @endsection --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Application</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{-- <link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css"> --}}
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js">




    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Demo App</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-container">
                            <div class="dropdown-toolbar">
                                <div class="dropdown-toolbar-actions">
                                    <a href="#">Mark all as read</a>
                                </div>
                                <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)
                                </h3>
                            </div>
                            <ul class="dropdown-menu">
                            </ul>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Timeline</a></li>
                    <li><a href="#">Friends</a></li>
                    <li> @guest
                            @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">

                            {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
																 document.g etElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                            <div>
                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
											data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
											{{ Auth::user()->name }}
									</a> --}}
                            </div>
                        </li>
                    @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="add_to_me">


    </div>
    <form action="#">
        @csrf
        <?php $auth = Auth::user()->id; ?>
        <input type="hidden" id="user_id" name="user_id" value="{{ $auth }}"><br>
        <label for="title">Enter Post:</label><br>
        <input type="text" id="title" name="title" value="" placeholder="Post..">
        <input type="submit" id="butsave" class="butsave" value="Submit">
    </form>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        var notificationsWrapper = $('.dropdown-notifications');
        var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount = parseInt(notificationsCountElem.data('count'));
        var notifications = notificationsWrapper.find('ul.dropdown-menu');
        if (notificationsCount <= 0) {
            notificationsWrapper.hide();
        }
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        var pusher = new Pusher('3821f53aaae46f663ab8', {
            encrypted: true
        });
        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('post-created');
        // Bind a function to a Event (the full Laravel class)
        channel.bind('App\\Events\\PostCreated', function(data) {

            console.log(data);
            //  alert(data.username.title);

            document.getElementById("add_to_me").innerHTML +=
                "<h3>" + data.username.title + "</h3>";
            //     var existingNotifications = notifications.html();
            //     var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            //     var newNotificationHtml = `
        //   <li class="notification active">
        //       <div class="media">
        //         <div class="media-left">
        //           <div class="media-object">
        //             <img src="https://api.adorable.io/avatars/71/` + avatar + `.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
        //           </div>
        //         </div>
        //         <div class="media-body">
        //           <strong class="notification-title">` + data.message + `</strong>
        //           <!--p class="notification-desc">Extra description can go here</p-->
        //           <div class="notification-meta">
        //             <small class="timestamp">about a minute ago</small>
        //           </div>
        //         </div>
        //       </div>
        //   </li>
        // `;
            //     notifications.html(newNotificationHtml + existingNotifications);
            //     notificationsCount += 1;
            //     notificationsCountElem.attr('data-count', notificationsCount);
            //     notificationsWrapper.find('.notif-count').text(notificationsCount);
            //     notificationsWrapper.show();
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#butsave').on('click', function() {
                var user_id = $('#user_id').val();
                var title = $('#title').val();

                if (title != "") {
                    /*  $("#butsave").attr("disabled", "disabled"); */
                    $.ajax({
                        url: "{{ route('create-post') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id,
                            title: title
                        },
                        cache: false,
                        success: function(dataResult) {
                            console.log(dataResult);
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                alert("Post Create Successfully !");
                            } else if (dataResult.statusCode == 201) {
                                alert("Error occured !");
                            }

                        }
                    });
                } else {
                    alert('Please fill title field !');
                }
            });
        });
    </script>
</body>

</html>
