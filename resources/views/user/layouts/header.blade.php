<!-- Header -->
<header id="header">
<style>
	.dropdown {
	    position: relative;
	    display: inline-block;
	}

	.dropdown-content {
	    display: none;
	    position: absolute;
	    background-color: #292929;
	    min-width: 160px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    padding: 12px 16px;
	    z-index: 1;
	}

	.dropdown:hover .dropdown-content {
	    display: block;
	}
</style>

	<h1><a href="index.html">Transit</a></h1>
	<nav id="nav">
		<ul>
			@if (Route::has('login'))
				<li><a href="{{ route('user.index') }}">Home</a></li>
				<li><a href="{{ route('admin.index') }}">Admin</a></li>
				<li><a href="{{ route('encuestas.index') }}">Encuestas</a></li>
				<li><a href="generic.html">Generic</a></li>
				<li><a href="elements.html">Elements</a></li>
				@if (Auth::check())
					
					<li class="dropdown">
					    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					        {{ Auth::user()->name }} <span class="caret"></span>
					    </a>

					    <ul class="dropdown-content" role="menu">
					        <li>
					        	<a href="#">Perfil</a>
					        </li>
					        <li>
					            <a href="{{ route('logout') }}"
					                onclick="event.preventDefault();
					                         document.getElementById('logout-form').submit();">
					                Logout
					            </a>

					            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					                {{ csrf_field() }}
					            </form>
					        </li>
					    </ul>
					</li>
					
				        
				@else
					<li><a href="{{ route('register') }}" class="button special">Sign Up</a></li>
					<li><a href="{{ route('login') }}" class="button special">Login</a></li>			    	

			 	@endif
			    
			@endif
		</ul>
	</nav>
</header>