<header class="header-section">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-lg p-0">
                        <a class="site-logo site-title" href="{{url('/')}}">
                            <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"  alt="@lang('site-logo')">
                        </a>

                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu ml-auto">

                                @auth
                                    <li><a href="{{route('user.home')}}">@lang('Dashboard')</a></li>
                                @endauth
                            </ul>
                            <div class="header-action">
                                @guest
                                    <a href="{{route('user.register')}}" class="btn--base">@lang('Criar Conta')</a>
                                    <a href="{{route('user.login')}}" class="btn--base active">@lang('Login')</a>
                                @else
                                    <a href="{{route('user.home')}}" class="btn--base active">@lang('Dashboard')</a>
                                @endguest
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
