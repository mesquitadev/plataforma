<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
            {{--                    <a class="text-muted" href="#">Subscribe</a>--}}
        </div>
        <div class="col-4 text-center">
            <div class="sidebar__logo">
                <a href="{{route('user.home')}}" class="sidebar__main-logo"><img
                        src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            </div>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            Olá, {{auth()->user()->firstname . ' ' . auth()->user()->lastname }}
        </div>
    </div>
</header>

<div class="nav-scroller py-1 mb-2">
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
                aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
            <ul class="navbar-nav">
                <li class="nav-item {{menuActive('user.home')}}">
                    <a href="{{route('user.home')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">Início</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{menuActive('user.home',3)}}">
                    <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown08"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="menu-icon las la-exchange-alt"></i>
                        <span class="menu-title">@lang('Meu Negócio')</span></a>
                    <div class="dropdown-menu {{menuActive('user.report*',2)}}  " aria-labelledby="dropdown08">

                        <ul>
                            <li><h6 class="dropdown-header">Meu Negócio</h6></li>
                            <li class="dropdown-item {{menuActive('user.report.invest')}}">
                                <a href="{{route('user.report.invest')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Investimentos')</span>
                                </a>
                            </li>
                            <li class="dropdown-item {{menuActive('user.report.refCom')}}">
                                <a href="{{route('user.report.refCom')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Meus Ganhos')</span>
                                </a>
                            </li>

                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ menuActive('user.bv.log') }}">
                    <a href="{{ route('user.bv.log') }}" class="nav-link">
                        <i class="menu-icon las la-sitemap"></i>
                        <span class="menu-title">@lang('Meu Volume')</span>
                    </a>
                </li>
                <li class="nav-item {{menuActive('user.plan.index')}}">
                    <a href="{{route('user.plan.index')}}" class="nav-link ">
                        <i class="menu-icon las la-lightbulb"></i>
                        <span class="menu-title">@lang('Planos / Cotas')</span>
                    </a>
                </li>


                <li class="nav-item {{ menuActive('user.my.ref') }}">
                    <a href="{{ route('user.my.ref') }}" class="nav-link">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Meus Indicados')</span>
                    </a>
                </li>

                <li class="nav-item {{ menuActive('user.deposit') }}">
                    <a href="{{ route('user.deposit') }}" class="nav-link">
                        <i class=" menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Depositar')</span>
                    </a>
                </li>
                <li class="nav-item {{ menuActive('user.withdraw') }}">
                    <a href="{{ route('user.withdraw') }}" class="nav-link">
                        <i class="menu-icon las la-cloud-download-alt"></i>
                        <span class="menu-title">@lang('Sacar')</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{menuActive('user.report*',3)}}">
                    <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown08"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="menu-icon las la-exchange-alt"></i>
                        <span class="menu-title">@lang('Relatórios') / @lang('Logs')</span></a>
                    <div class="dropdown-menu {{menuActive('user.report*',2)}}  " aria-labelledby="dropdown08">
                        <ul>
                            <li class="dropdown-item {{menuActive('user.report.transactions')}} ">
                                <a href="{{route('user.report.transactions')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transações')</span>
                                </a>
                            </li>

                            <li class="dropdown-item {{menuActive('user.report.deposit')}}">
                                <a href="{{route('user.report.deposit')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Depósitos')</span>
                                </a>
                            </li>

                            <li class="dropdown-item {{menuActive('user.report.withdraw')}}">
                                <a href="{{route('user.report.withdraw')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Saques')</span>
                                </a>
                            </li>

                            <li class="dropdown-item {{menuActive('user.report.invest')}}">
                                <a href="{{route('user.report.invest')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Investimentos')</span>
                                </a>
                            </li>
                            <li class="dropdown-item {{menuActive('user.report.refCom')}}">
                                <a href="{{route('user.report.refCom')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Comissões de Indicação')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ menuActive('user.profile-setting') }}">
                    <a href="{{ route('user.profile-setting') }}" class="nav-link">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Perfil')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.logout') }}" class="nav-link">
                        <i class="menu-icon las la-sign-out-alt"></i>
                        <span class="menu-title">@lang('Sair')</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
