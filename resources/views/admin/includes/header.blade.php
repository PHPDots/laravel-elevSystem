<header>
    <span id="mobileNav">
        <img src="{{ asset('img/mobile-icon.png') }}" alt="Elev System">
    </span>
    <span id="phoneNav">
        <img src="{{ asset('img/mobile-icon.png') }}" alt="Elev System">
    </span>
        
    <ul class="header-actions"> 
            <li>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/icon/14x14/header/settings.png') }}">
                </a>
                <div class="dropdown">
                    <div class="dropdown-inner">
                        <div class="summary">
                            <strong>{{ __('Settings') }}</strong>{{ __('for your account') }}
                        </div>
                        <a href="" class="dropdown-block clearfix">
                            <span class="head">
                                <img src="{{ asset('img/icon/14x14/light/grid.png') }}">{{ __('Edit Profile') }}
                            </span>
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-block clearfix">
                            <span class="head">
                                <img src="{{ asset('img/icon/14x14/header/settings.png') }}">{{ __('Log ud') }}
                            </span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
        
        <div class="logUser">
            <a href="" class="logUserImg">
                {{ Auth::user()->email_id }}
            </a>
            <div class="logUserInfo">{{ __('Welcome') }}
                {{ \Auth::user()->firstname}}
                <div class="clear"></div>
            </div>
        </div>

        <div class="logUser" style="margin-top: 20px; color: white; font-weight: bold; font-size: 15px;">
            {{ date('d-m-Y h:i:s A') }}
        </div>

    <div id="exc"></div>
</header>