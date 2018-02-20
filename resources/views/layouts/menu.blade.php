<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Automobili</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        @if (!Auth::guest())
        <a class="navbar-brand" href="#">User: {{ Auth::user()->name }} <span class="caret"></span></a>
        @endif

          <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            @if (Auth::guest())
            <li class="nav-item"><a class="nav-link" href="{{url('/automobili')}}">Automobili</a></li>
            @endif
            @if(Auth::check() && Auth::user()->admin == true)
              <li class="nav-item"><a class="nav-link" href="{{url('/adminAutomobili')}}">Automobili</a></li>
              <li class="nav-item"><a class="nav-link" href="{{url('/dashboard')}}">Odobravenje</a></li>
              <li class="nav-item"><a class="nav-link" href="{{url('/createKategoriju')}}">Kategorije</a></li>
            @elseif (Auth::check() && Auth::user()->admin == false)
            <li class="nav-item"><a class="nav-link" href="{{url('/automobili')}}">Automobili</a></li>
              <li class="nav-item"><a class="nav-link" href="{{url('/automobili/create')}}">Kreiraj oglas</a></li>
            @endif
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
                    <li>
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
            @endif
          </ul>
      </div>
    </div>
    </nav>