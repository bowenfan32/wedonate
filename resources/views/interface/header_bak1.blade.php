<nav class="navbar menu-primary">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('getHome') }}"><img src="{{ asset('img/logo/long_logo_beta.png') }}" style="max-height: 20px;"><span style="display:none">weDonate</a></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
				<li><a href="{{ route('getHome') }}">Volunteer</a></li>
				<li><a href="{{ route('getAbout') }}">About we</a></li>
        @if (Auth::check())
          <li><a href="#" data-toggle="modal" data-target="#global-donate-popup">Donate Now</a></li>
        @else
          <li><a href="#" data-toggle="modal" data-target="#global-connect-popup">Connect</a></li>
        @endif
				<li><a href="{{ route('getDonate') }}">Donate</a></li>
				<li><a href="{{ route('getSponsors') }}">Sponsors</a></li>
				<li><a href="#" data-toggle="modal" data-target="#global-share-popup">Share</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
			    <li><a href="{{ route('getDash') }}">Dashboard</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a>
            <ul class="dropdown-menu">
    			    <li><a href="{{ route('getLogout') }}">Logout</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
