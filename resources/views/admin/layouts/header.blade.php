<aside class="sidebar fixed" style="width: 260px; left: 0px; ">
  <div class="brand-logo">
    <div id="logo">
      <div class="foot1"></div>
      <div class="foot2"></div>
      <div class="foot3"></div>
      <div class="foot4"></div>
    </div> Poll </div>
  <div class="user-logged-in">
    <div class="content">
      <div class="user-name">
        @if (Auth::guest())
          Moises 
         @else
          {{ Auth::user()->name }}
         @endif

        <span class="text-muted f9">admin</span>
      </div>
      <div class="user-email">last@samurai.jp</div>
      <div class="user-actions"> 
        <a class="m-r-5" href="#">settings</a> 
        {{-- <a href="#">logout</a>  --}}
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Salir
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
  <ul class="menu-links">
    <li icon="md md-blur-on"> <a href="index-2.html"><i class="md md-blur-on"></i>&nbsp;<span>Dashboard</span></a></li>
    <li> <a href="#" data-toggle="collapse" data-target="#APPS" aria-expanded="false" aria-controls="APPS" class="collapsible-header waves-effect"><i class="md md-camera"></i>&nbsp;APPS</a>
      <ul id="APPS" class="collapse">
        <li name="Todo">
          <a href="apps-todo.html"> <span id="todosCount" class="pull-right badge z-depth-0">2</span><span>        Todo      </span></a>
        </li>
        <li name="Crud">
          <a href="apps-crud.html"> <span class="pull-right badge theme-primary-bg z-depth-0">9</span><span>        Crud      </span></a>
        </li>
      </ul>
    </li>
    <li> <a href="#" data-toggle="collapse" data-target="#Forms" aria-expanded="false" aria-controls="Forms" class="collapsible-header waves-effect"><i class="md md-input"></i>&nbsp;Encuestas</a>
      <ul id="Forms" class="collapse">
        <li> <a href="forms-basic.html"><span>Basic forms</span></a></li>
        <li> <a href="forms-advanced.html"><span>Advanced elements</span></a></li>
        <li> <a href="forms-validation.html"><span>Validation</span></a></li>
      </ul>
    </li>
    <li> <a href="#" data-toggle="collapse" data-target="#UIelements" aria-expanded="false" aria-controls="UIelements" class="collapsible-header waves-effect"><i class="md md-photo"></i>&nbsp;UI elements</a>
      <ul id="UIelements" class="collapse">
        <li> <a href="ui-elements-cards.html"><span>Cards</span></a></li>
        <li> <a href="ui-elements-colors.html"><span>Color</span></a></li>
        <li> <a href="ui-elements-grid.html"><span>Grid</span></a></li>
        <li> <a href="ui-elements-icons.html"><span>Icons material design</span></a></li>
        <li> <a href="ui-elements-weather-icons.html"><span>Icons weather</span></a></li>
        <li> <a href="ui-elements-lists.html"><span>Lists</span></a></li>
        <li> <a href="ui-elements-typography.html"><span>Typography</span></a></li>
        <li> <a href="ui-elements-messages.html"><span>Messages &amp; Notifications</span></a></li>
        <li> <a href="ui-elements-buttons.html"><span>Buttons</span></a></li>
      </ul>
    </li>
    <li> <a href="#" data-toggle="collapse" data-target="#Forms" aria-expanded="false" aria-controls="Forms" class="collapsible-header waves-effect"><i class="md md-input"></i>&nbsp;Forms</a>
      <ul id="Forms" class="collapse">
        <li> <a href="forms-basic.html"><span>Basic forms</span></a></li>
        <li> <a href="forms-advanced.html"><span>Advanced elements</span></a></li>
        <li> <a href="forms-validation.html"><span>Validation</span></a></li>
      </ul>
    </li>
    <li> <a href="#" data-toggle="collapse" data-target="#Tables" aria-expanded="false" aria-controls="Tables" class="collapsible-header waves-effect"><i class="md md-list"></i>&nbsp;Tables</a>
      <ul id="Tables" class="collapse">
        <li> <a href="tables-basic.html"><span>Basic tables</span></a></li>
        <li> <a href="tables-data.html"><span>Data tables</span></a></li>
      </ul>
    </li>
    <li> <a href="#" data-toggle="collapse" data-target="#Maps" aria-expanded="false" aria-controls="Maps" class="collapsible-header waves-effect"><i class="md md-place"></i>&nbsp;Maps</a>
      <ul id="Maps" class="collapse">
        <li> <a href="maps-full-map.html"><span>Full map</span></a></li>
        <li> <a href="maps-map-widgets.html"><span>Map widgets</span></a></li>
        <li> <a href="maps-vector-map.html"><span>Vector map</span></a></li>
      </ul>
    </li>
    <li icon="md md-insert-chart"> <a href="charts.html"><i class="md md-insert-chart"></i>&nbsp;<span>Charts</span></a></li>
    <li> <a href="#" data-toggle="collapse" data-target="#Extrapages" aria-expanded="false" aria-controls="Extrapages" class="collapsible-header waves-effect"><i class="md md-favorite-outline"></i>&nbsp;Extra pages</a>
      <ul id="Extrapages" class="collapse"> 
      <a target="_blank" href="{{ route('admin.login') }}">Login</a> 
      <a target="_blank" href="pages-404.html">404</a> 
      <a target="_blank" href="pages-500.html">500</a> <a target="_blank" href="pages-material-bird.html">Easter Egg</a> </ul>
    </li>
  </ul>
</aside>