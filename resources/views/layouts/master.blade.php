<!doctype html>
<html>
<head>
  @include('includes.head')
</head>
<body>
  <div class="container">
    <header class="row">
      @if(Auth::check())
      @include('includes.header')
      @else
        <br>
      @endif
    </header>
    <div id="main" class="row">
      @yield('content')
    </div>
    <footer class="row">
      @include('includes.footer')
    </footer>
  </div>
</body>
</html>