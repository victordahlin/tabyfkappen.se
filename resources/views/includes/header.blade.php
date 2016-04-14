<!-- Static navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Täby FK</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('categories') }}">{{ trans('messages.categories') }}</a></li>
        <li><a href="{{ url('companies') }}">{{ trans('messages.companies') }}</a></li>
        <li><a href="{{ url('offers') }}">{{ trans('messages.offers') }}</a></li>
        <li><a href="{!! url('users') !!}">{{ trans('messages.users') }}</a></li>
        <li><a href="{!! url('information') !!}">{{ trans('messages.information') }}</a></li>
        <li><a href="{!! url('statistics') !!}">{{ trans('messages.statistic') }}</a></li>
        <li><a href="{!! url('activation-codes') !!}">{{ trans('messages.activation-codes') }}</a></li>
        <li><a href="{!! url('settings') !!}">{{ trans('messages.settings') }}</a></li>
        @if(Auth::check())
        <li>
          <a href="{!! url('auth/logout') !!}">Logga ut</a>
        </li>
        @endif
      </ul>
  </div><!--/.container-fluid -->
</nav>
