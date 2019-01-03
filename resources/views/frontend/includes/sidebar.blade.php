<div class="navbar-header">
  <button type="button" class="navbar-toggle menu-toggle pull-right" data-toggle="collapse" 
          data-target="#menu">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
 </button>
</div>
<div class="collapse navbar-collapse menu-default" id="menu">
  <ul class="nav navbar-nav sidebar-item">
    <li class="has-submenu">
      <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Forside') }}</a>
    </li>
    <li class="has-submenu">
      <a href="{{ route('myProfile') }}"><i class="fa fa-user"></i> {{ __('Din profil') }}</a>
    </li>
    <li class="has-submenu">
        <a href="{{ route('drivingLessons')}}"><i class="fa fa-car"></i> {{ __('Køretimer') }}</a>
    </li>
    <li class="has-submenu">
        <a href="{{ route('courseTimes') }}"><i class="fa fa-car"></i> {{ __('Banetider') }}</a>
    </li>
    <li class="has-submenu">
        <a href="{{ route('finances') }}"><i class="fa fa-money"></i> {{ __('Din Økonomi') }}</a>
    </li>
    <li class="has-submenu">
        <a href="{{ route('documents')}}"><i class="fa fa-list-alt"></i> {{ __('Dokumenter') }}</a>
    </li>
    <li class="has-submenu">
        <a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a>
    </li>
  </ul>
</div>
