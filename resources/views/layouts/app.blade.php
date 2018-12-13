<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="app-blade">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'OTG!') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/Votes.js') }}" defer></script>
  <script src="{{ asset('js/Story.js') }}" defer></script>
  <script src="{{ asset('js/Comments.js') }}" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
      <a class="navbar-brand home-otg" href="{{ url('/') }}">
        {{ config('app.name', 'OTG!') }}
      </a>
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav ml-auto mr-auto">
            <li class="nav-item mr-4 ml-4 li-otg">
              <a class="nav-link" href="{{ route('createStory') }}">Ecrire</a>
            </li>
            <li class="nav-item mr-4 ml-4 li-otg">
              <a class="nav-link" href="{{ route('stories.random') }}">Aléatoire</a>
            </li>
            <li class="nav-item mr-4 ml-4 li-otg">
              <a class="nav-link" href="{{ route('stories.fresh') }}">Nouveau</a>
            </li>
            <li class="nav-item mr-4 ml-4 li-otg">
              <a class="nav-link" href="{{ route('stories.top') }}">Top!</a>
            </li>
            <li class="nav-item mr-4 ml-4 li-otg dropdown">
              <a id="navbarDropdownTheme" class="nav-link dropdown-toggle a-otg" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Thèmes <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-otg" aria-labelledby="navbarDropdownTheme">
                <ul  class="ml-auto mr-auto">
                  @foreach (App\Theme::all() as $theme)
                    <a class="dropdown-item dropdown-item-otg" href="{{ route('stories.byTheme', ['id' => $theme->id]) }}">{{ $theme->name }}</a>
                  @endforeach
                </ul>
              </div>
            </li>
          </ul>
          <div class="dropdown-divider"></div>
          <ul class="navbar-nav">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item mr-4 ml-4 li-otg">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
            </li>
            <li class="nav-item mr-4 ml-4 li-otg">
              @if (Route::has('register'))
              <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
              @endif
            </li>
            @else
            <li class="nav-item mr-4 ml-4 li-otg dropdown">
              <a id="navbarDropdownUser" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right dropdown-otg" aria-labelledby="navbarDropdownUser">
                <ul  class="ml-auto mr-auto">
                  <a class="dropdown-item dropdown-item-otg" href="{{ route('stories.byUser', ['id' => Auth::user()->id]) }}">Mes histoires</a>
                  @if (Auth::user()->admin)
                  <a class="dropdown-item dropdown-item-otg" href="{{ route('themes.index') }}">Thèmes</a>
                  <a class="dropdown-item dropdown-item-otg" href="{{ route('constraints.index') }}">Contraintes</a>
                  @endif
                  <a class="dropdown-item dropdown-item-otg" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </ul>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
      <!-- Right Side Of Navbar -->

    </nav>
    <main class="py-4 mt-2">
      @yield('content')
    </main>
  </div>
</body>
</html>
