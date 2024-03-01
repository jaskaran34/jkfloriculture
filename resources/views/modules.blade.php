
<html>

<head>
    <link href="{{ asset('build/assets/app-D-sv12UV.css') }}" rel="stylesheet">
    <!-- Additional stylesheets -->
</head>
<body>


<!-- Your HTML content -->

<script src="{{ asset('build/assets/app-DFMGEaK5.js') }}"></script>
<!-- Additional scripts -->
<div class="container">
    <div class="row" style="margin-bottom: 2%;">
        <div class="col-12">

            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;padding: 0px;">
                <a class="navbar-brand" href="/">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarText" aria-controls="navbarText"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active" style="border-right: 2px solid white;border-left: 2px solid white;width: 100px;
                        font-weight: 600;font-size:15px;

                        ">
                            <a class="nav-link" href="/" @if (Request::is('/'))
                            style="background-color:#81c6f9;color:blue;"
                                @endif
                            >

                                <img class="img-fluid" src="{{ asset('include/images/house.svg') }}">&nbsp;Home</a>
                        </li>
                        <li class="nav-item active" style="border-right: 2px solid white;width: 100px;font-weight: 600;font-size:15px;">
                            <a class="nav-link" href="{{route('login')}}"
                            @if(Route::currentRouteName()=='login')
                         style="background-color:#81c6f9;color:blue;"
                       @endif
                            >

                                Login</a>
                        </li>

                    </ul>

                </div>
            </nav>
            <div style="margin-top: 5px;">
                <img class="img-fluid" src="{{ asset('include/images/Tulip11.png') }}">
            </div>
        </div>

    </div>
@yield('extend');

    </div>
</body>
</html>

