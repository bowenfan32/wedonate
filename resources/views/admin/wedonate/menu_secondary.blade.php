<nav class="navbar menu-secondary">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Causes <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('getCauses') }}">View All Causes</a></li>
            <li><a href="{{ route('getCauses') }}">Cause of the Month</a></li>
          </ul>
        </li>
        <li><a href="{{ route('getFunds') }}">Funds</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Donations <span class="caret"></span></a>
					<ul class="dropdown-menu">
	        	<li><a href="{{ route('getDonations') }}">Donations</a></li>
						<li><a href="#">Breakdown</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
					<ul class="dropdown-menu">
		        <li><a href="{{ route('getUsers') }}">Users</a></li>
		        <li><a href="{{ route('getRoles') }}">Roles</a></li>
		        <li><a href="{{ route('getPermissions') }}">Permissions</a></li>
					</ul>
				</li>
        <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages and Sections <span class="caret"></span></a>
					<ul class="dropdown-menu">
            <li><a href="{{ route('getPages') }}">Pages</a></li>
            <li><a href="{{ route('getSections') }}">Sections</a></li>
					</ul>
				</li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
