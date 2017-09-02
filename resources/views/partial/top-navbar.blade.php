<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/"><img width="60" height="60" src="{{ asset('download.png') }}" alt="banner-img"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <a class="navbar-brand" href="{{route('website-form')}}">Register a website</a>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->last_name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/">Home</a></li>
            <li><a href="{{route('visitors')}}">New Visitors</a></li>
            <li><a href="{{route('lead')}}">Leads</a></li>
            <li><a href="{{route('competitor')}}">Competitors</a></li>
            <li><a href="{{route('customer')}}">Customers</a></li>
            <li><a href="{{route('dashboard-index')}}">Dashboard</a></li>
            <li><a href="{{route('profile')}}">Settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('getLogout')}}">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>