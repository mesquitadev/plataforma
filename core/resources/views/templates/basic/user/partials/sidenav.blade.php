
<div class="sidebar capsule--rounded bg_img overlay--dark"
     data-background="{{asset('assets/admin/images/sidebar/2.jpg')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('user.home')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('user.home')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('user.home')}}">
                    <a href="{{route('user.home')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Meu Negócio')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('user.plan.index')}}">
                    <a href="{{route('user.plan.index')}}" class="nav-link ">
                        <i class="menu-icon las la-lightbulb"></i>
                        <span class="menu-title">@lang('Planos / Cotas')</span>
                    </a>
                </li>



                <li class="sidebar-menu-item {{ menuActive('user.bv.log') }}">
                    <a href="{{ route('user.bv.log') }}" class="nav-link">
                        <i class="menu-icon las la-sitemap"></i>
                        <span class="menu-title">@lang('Meu Volume')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.my.ref') }}">
                    <a href="{{ route('user.my.ref') }}" class="nav-link">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Meus Indicados')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('user.deposit') }}">
                    <a href="{{ route('user.deposit') }}" class="nav-link">
                        <i class=" menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Depositar')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.withdraw') }}">
                    <a href="{{ route('user.withdraw') }}" class="nav-link">
                        <i class="menu-icon las la-cloud-download-alt"></i>
                        <span class="menu-title">@lang('Sacar')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.balance.transfer') }}">
                    <a href="{{ route('user.balance.transfer') }}" class="nav-link">
                        <i class="menu-icon las la-hand-holding-usd"></i>
                        <span class="menu-title">@lang('Transferências')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('user.report*',3)}} my-2">
                        <i class="menu-icon las la-exchange-alt"></i>
                        <span class="menu-title">@lang('Relatórios') / @lang('Logs')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('user.report*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('user.report.transactions')}} ">
                                <a href="{{route('user.report.transactions')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transações')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('user.report.deposit')}}">
                                <a href="{{route('user.report.deposit')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Depósitos')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('user.report.withdraw')}}">
                                <a href="{{route('user.report.withdraw')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Saques')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('user.report.invest')}}">
                                <a href="{{route('user.report.invest')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Investimentos')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('user.report.refCom')}}">
                                <a href="{{route('user.report.refCom')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Comissões de Indicação')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item {{ menuActive('user.twofactor') }}">
                    <a href="{{ route('user.twofactor') }}" class="nav-link">
                        <i class="menu-icon las la-shield-alt"></i>
                        <span class="menu-title">@lang('Segurança em 2 Fatores')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('ticket') }}">
                    <a href="{{ route('ticket') }}" class="nav-link">
                        <i class="menu-icon las la-ticket-alt"></i>
                        <span class="menu-title">@lang('Suporte')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('user.profile-setting') }}">
                    <a href="{{ route('user.profile-setting') }}" class="nav-link">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Perfil')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.login.history') }}">
                    <a href="{{ route('user.login.history') }}" class="nav-link">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Histórico de Login')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('user.logout') }}" class="nav-link">
                        <i class="menu-icon las la-sign-out-alt"></i>
                        <span class="menu-title">@lang('Sair')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

