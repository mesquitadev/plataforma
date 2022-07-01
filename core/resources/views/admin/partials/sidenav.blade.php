<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage('assets/admin/images/sidebar/2.jpg','400x800')}}">


    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('admin.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('admin.dashboard')}}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.plan*')}}">
                    <a href="{{route('admin.plan')}}" class="nav-link ">
                        <i class="menu-icon las la-paper-plane"></i>
                        <span class="menu-title">@lang('Planos / Cotas')</span>
                    </a>
                </li>



                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.users*',3)}}">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Usuários')</span>

                        @if($banned_users_count > 0 || $email_unverified_users_count > 0 || $sms_unverified_users_count > 0)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.users*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.users.all')}} ">
                                <a href="{{route('admin.users.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Todos')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.users.active')}} ">
                                <a href="{{route('admin.users.active')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Ativos')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.users.banned')}} ">
                                <a href="{{route('admin.users.banned')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banidos')</span>
                                    @if($banned_users_count)
                                        <span class="menu-badge pill bg--primary ml-auto">{{$banned_users_count}}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item  {{menuActive('admin.users.emailUnverified')}}">
                                <a href="{{route('admin.users.emailUnverified')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Não Verificado')</span>

                                    @if($email_unverified_users_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{$email_unverified_users_count}}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.users.smsUnverified')}}">
                                <a href="{{route('admin.users.smsUnverified')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('SMS Não Verificado')</span>
                                    @if($sms_unverified_users_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{$sms_unverified_users_count}}</span>
                                    @endif
                                </a>
                            </li>


                            <li class="sidebar-menu-item {{menuActive('admin.users.email.all')}}">
                                <a href="{{route('admin.users.email.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Enviar Email')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>



                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.deposit*',3)}}">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Depósitos')</span>
                        @if(0 < $pending_deposits_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.deposit*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.pending')}} ">
                                <a href="{{route('admin.deposit.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pendentes')</span>
                                    @if($pending_deposits_count)
                                        <span class="menu-badge pill bg--primary ml-auto">{{$pending_deposits_count}}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.approved')}} ">
                                <a href="{{route('admin.deposit.approved')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Aprovados')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.successful')}} ">
                                <a href="{{route('admin.deposit.successful')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Concluidos')</span>
                                </a>
                            </li>


                            <li class="sidebar-menu-item {{menuActive('admin.deposit.rejected')}} ">
                                <a href="{{route('admin.deposit.rejected')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rejeitados')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.list')}} ">
                                <a href="{{route('admin.deposit.list')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Todos')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.withdraw*',3)}}">
                        <i class="menu-icon la la-bank"></i>
                        <span class="menu-title">@lang('Saques') </span>
                        @if(0 < $pending_withdraw_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.withdraw*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.withdraw.method.index')}}">
                                <a href="{{route('admin.withdraw.method.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Métodos')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.withdraw.pending')}} ">
                                <a href="{{route('admin.withdraw.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pendentes')</span>

                                    @if($pending_withdraw_count)
                                        <span class="menu-badge pill bg--primary ml-auto">{{$pending_withdraw_count}}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.withdraw.approved')}} ">
                                <a href="{{route('admin.withdraw.approved')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Aprovados')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.withdraw.rejected')}} ">
                                <a href="{{route('admin.withdraw.rejected')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Negados')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.withdraw.log')}} ">
                                <a href="{{route('admin.withdraw.log')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Extrato')</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.ticket*',3)}}">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title">@lang('Suporte') </span>
                        @if(0 < $pending_ticket_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.ticket*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.ticket')}} ">
                                <a href="{{route('admin.ticket')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Todos')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.pending')}} ">
                                <a href="{{route('admin.ticket.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pendentes')</span>
                                    @if($pending_ticket_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{$pending_ticket_count}}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.closed')}} ">
                                <a href="{{route('admin.ticket.closed')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Fechados')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.answered')}} ">
                                <a href="{{route('admin.ticket.answered')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Respondidos')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.report*',3)}}">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Relatórios') </span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.report*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive(['admin.report.transaction','admin.report.transaction.search'])}}">
                                <a href="{{route('admin.report.transaction')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transações')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive(['admin.report.invest'])}}">
                                <a href="{{route('admin.report.invest')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Log de Investimentos')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.report.bvLog'])}}">
                                <a href="{{route('admin.report.bvLog')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Log de Comissões')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.report.refCom'])}}">
                                <a href="{{route('admin.report.refCom')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Comissão de Indicação')</span>
                                </a>
                            </li>



                            <li class="sidebar-menu-item {{menuActive(['admin.report.login.history','admin.report.login.ipHistory'])}}">
                                <a href="{{route('admin.report.login.history')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Histórico de Login')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item  {{menuActive('admin.subscriber.index')}}">
                    <a href="{{route('admin.subscriber.index')}}" class="nav-link"
                       data-default-url="{{ route('admin.subscriber.index') }}">
                        <i class="menu-icon las la-thumbs-up"></i>
                        <span class="menu-title">@lang('Assinantes') </span>
                    </a>
                </li>


                <li class="sidebar__menu-header">@lang('Settings')</li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.index')}}">
                    <a href="{{route('admin.setting.index')}}" class="nav-link">
                        <i class="menu-icon las la-life-ring"></i>
                        <span class="menu-title">@lang('Configurações')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.logo_icon')}}">
                    <a href="{{route('admin.setting.logo_icon')}}" class="nav-link">
                        <i class="menu-icon las la-images"></i>
                        <span class="menu-title">@lang('Logo e Ícone')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.gateway*',3)}}">
                        <i class="menu-icon la la-paypal"></i>
                        <span class="menu-title">@lang('Gateways de Pagamento')</span>

                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.gateway*',2)}} ">
                        <ul>

{{--                            <li class="sidebar-menu-item {{menuActive('admin.gateway.automatic.index')}} ">--}}
{{--                                <a href="{{route('admin.gateway.automatic.index')}}" class="nav-link">--}}
{{--                                    <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                    <span class="menu-title">@lang('Automatic Gateways')</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="sidebar-menu-item {{menuActive('admin.gateway.manual.index')}} ">
                                <a href="{{route('admin.gateway.manual.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Gateways Manuais')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.extensions.index')}}">
                    <a href="{{route('admin.extensions.index')}}" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title">@lang('Extensões')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{menuActive(['admin.language.manage','admin.language.key'])}}">
                    <a href="{{route('admin.language.manage')}}" class="nav-link"
                       data-default-url="{{ route('admin.language.manage') }}">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title">@lang('Idiomas') </span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.seo')}}">
                    <a href="{{route('admin.seo')}}" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title">@lang('Gerenciador SEO')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.notice')}}">
                    <a href="{{route('admin.setting.notice')}}" class="nav-link">
                        <i class="menu-icon las la-exclamation-triangle"></i>
                        <span class="menu-title">@lang('Avisos')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.email.template*',3)}}">
                        <i class="menu-icon la la-envelope-o"></i>
                        <span class="menu-title">@lang('Gerenciador de Emails')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.email.template*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.email.template.global')}} ">
                                <a href="{{route('admin.email.template.global')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Template Global')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.email.template.index','admin.email.template.edit'])}} ">
                                <a href="{{ route('admin.email.template.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Templates de Email')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.email.template.setting')}} ">
                                <a href="{{route('admin.email.template.setting')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Configurar Email')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

{{--                <li class="sidebar-menu-item sidebar-dropdown">--}}
{{--                    <a href="javascript:void(0)" class="{{menuActive('admin.sms.template*',3)}}">--}}
{{--                        <i class="menu-icon la la-mobile"></i>--}}
{{--                        <span class="menu-title">@lang('SMS Manager')</span>--}}
{{--                    </a>--}}
{{--                    <div class="sidebar-submenu {{menuActive('admin.sms.template*',2)}} ">--}}
{{--                        <ul>--}}
{{--                            <li class="sidebar-menu-item {{menuActive('admin.sms.template.global')}} ">--}}
{{--                                <a href="{{route('admin.sms.template.global')}}" class="nav-link">--}}
{{--                                    <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                    <span class="menu-title">@lang('API Setting')</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="sidebar-menu-item {{menuActive(['admin.sms.template.index','admin.sms.template.edit'])}} ">--}}
{{--                                <a href="{{ route('admin.sms.template.index') }}" class="nav-link">--}}
{{--                                    <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                    <span class="menu-title">@lang('SMS Templates')</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}


                {{-- <li class="sidebar__menu-header">@lang('TEMPLATES')</li> --}}



                <li class="sidebar__menu-header">@lang('Site')</li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.templates')}}">
                    <a href="{{route('admin.frontend.templates')}}" class="nav-link ">
                        <i class="menu-icon la la-html5"></i>
                        <span class="menu-title">@lang('Gerenciar Templates')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.manage.pages')}}">
                    <a href="{{route('admin.frontend.manage.pages')}}" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Gerenciar')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.frontend.sections*',3)}}">
                        <i class="menu-icon la la-html5"></i>
                        <span class="menu-title">@lang('Gerenciar Seções')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.frontend.sections*',2)}} ">
                        <ul>
                            @php
                               $lastSegment =  collect(request()->segments())->last();
                            @endphp
                            @foreach(getPageSections(true) as $k => $secs)
                                @if($secs['builder'])
                                    <li class="sidebar-menu-item  @if($lastSegment == $k) active @endif ">
                                        <a href="{{ route('admin.frontend.sections',$k) }}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">{{__($secs['name'])}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach


                        </ul>
                    </div>
                </li>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{systemDetails()['name']}}</span>
                <span class="text--success">@lang('V'){{systemDetails()['version']}} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->
