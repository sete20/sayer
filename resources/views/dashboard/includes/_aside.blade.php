<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ url('dashboard') }}/uploads/users/{{ auth('admin')->user()->avatar }}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>@lang('admin.welcome'),</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ auth('admin')->user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account animated flipInY">
                    <li><a href="#"><i class="icon-user"></i>@lang('admin.my_profile')</a></li>
                    <li><a href="#"><i class="icon-envelope-open"></i>@lang('admin.messages')</a></li>
                    <li><a href="{{ route('dashboard.configs.edit') }}"><i class="icon-settings"></i>@lang('admin.settings')</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-power"></i>@lang('admin.logout')</a></li>
                </ul>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <h6>5+</h6>
                    <small>@lang('admin.experience')</small>
                </div>
                <div class="col-4">
                    <h6>400+</h6>
                    <small>@lang('admin.employees')</small>
                </div>
                <div class="col-4">
                    <h6>80+</h6>
                    <small>@lang('admin.clients')</small>
                </div>
            </div>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item {{ request()->segment(2) != 'deliveries' ? 'active': '' }}"><a class="nav-link  {{ request()->segment(2) != 'deliveries' ? 'active': '' }}" data-toggle="tab" href="#hr_menu">@lang('admin.main')</a></li>
            <li class="nav-item {{ request()->segment(2) == 'deliveries' ? 'active': '' }}"><a class="nav-link {{ request()->segment(2) == 'deliveries' ? 'active': '' }}" data-toggle="tab" href="#delivery">@lang('admin.delivery')</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane animated fadeIn {{ request()->segment(2) != 'deliveries' ? 'active': '' }}" id="hr_menu">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li class="active"><a href="{{ route('dashboard.home') }}"><i class="icon-speedometer"></i><span>@lang('admin.dashboard')</span></a></li>
                        <li>
                            <a href="#Admins" class="has-arrow"><i class="icon-user-follow"></i> <span>@lang('admin.admins')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.laratrust.roles-assignment.index') }}">@lang('admin.admins')</a></li>
                                <li><a href="{{ route('dashboard.laratrust.roles.index') }}">@lang('admin.roles')</a></li>
                                <li><a href="{{ route('dashboard.laratrust.permissions.index') }}">@lang('admin.permissions')</a></li>
                                <li><a href="{{ route('dashboard.logs.index') }}">@lang('admin.logs')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Countries" class="has-arrow"><i class="icon-flag"></i> <span>@lang('admin.countries_cities_states')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.countries.index') }}">@lang('admin.countries')</a></li>
                                <li><a href="{{ route('dashboard.cities.index') }}">@lang('admin.cities')</a></li>
                                <li><a href="{{ route('dashboard.states.index') }}">@lang('admin.states')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Services" class="has-arrow"><i class="icon-key"></i> <span>@lang('admin.services_and_costs')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.services.index') }}">@lang('admin.services')</a></li>
                                <li><a href="{{ route('dashboard.service-costs.index') }}">@lang('admin.service-costs')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#CompanyMinions" class="has-arrow"><i class="icon-bubbles"></i> <span>@lang('admin.company_minions')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.company-assets.index') }}">@lang('admin.company-assets')</a></li>
                                <li><a href="{{ route('dashboard.company-cars.index') }}">@lang('admin.company-cars')</a></li>
                                <li><a href="{{ route('dashboard.violations.index') }}">@lang('admin.trafficViolations')</a></li>
                                <li><a href="{{ route('dashboard.documents.index') }}">@lang('admin.documents')</a></li>
                                <li><a href="{{ route('dashboard.custodies.index') }}">@lang('admin.custodies')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Users" class="has-arrow"><i class="icon-users"></i> <span>@lang('admin.users')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.users.index') }}">@lang('admin.all_users')</a></li>
                                <li><a href="{{ route('dashboard.users.index') }}?type=1">@lang('admin.delivery_employees')</a></li>
                                <li><a href="{{ route('dashboard.users.index') }}?type=2">@lang('admin.delivery_representatives')</a></li>
                                <li><a href="{{ route('dashboard.users.index') }}?type=3">@lang('admin.companies')</a></li>
                                <li><a href="{{ route('dashboard.users.index') }}?type=4">@lang('admin.individuals')</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('dashboard.terms.index') }}"><i class="icon-question"></i>@lang('admin.terms')</a></li>
                        <li><a href="{{ route('dashboard.configs.edit') }}"><i class="icon-settings"></i>@lang('admin.settings')</a></li>
                        <li>
                            <a href="#Authentication" class="has-arrow"><i class="icon-lock"></i><span>Authentication</span></a>
                            <ul>
                                <li><a href="page-login.html">Login</a></li>
                                <li><a href="page-register.html">Register</a></li>
                                <li><a href="page-lockscreen.html">Lockscreen</a></li>
                                <li><a href="page-forgot-password.html">Forgot Password</a></li>
                                <li><a href="page-404.html">Page 404</a></li>
                                <li><a href="page-403.html">Page 403</a></li>
                                <li><a href="page-500.html">Page 500</a></li>
                                <li><a href="page-503.html">Page 503</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="tab-pane animated fadeIn {{ request()->segment(2) == 'deliveries' ? 'active': '' }}" id="delivery">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li class="{{ request()->segment(2) == 'deliveries' ? 'active': '' }}">
                            <a href="#LocalDeliveries" class="has-arrow"><i class="icon-bag"></i> <span>@lang('admin.local_delivery')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.deliveries.index') }}">@lang('admin.all_local_delivery')</a></li>
                                <li class="{{ request('status') == 1 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=1">@lang('admin.new_deliveries')</a></li>
                                <li class="{{ request('status') == 2 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=2">@lang('admin.request_delegate_deliveries')</a></li>
                                <li class="{{ request('status') == 3 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=3">@lang('admin.request_delegate_deliveries_submit')</a></li>
                                <li class="{{ request('status') == 4 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=4">@lang('admin.request_submit_in_office')</a></li>
                                <li class="{{ request('status') == 5 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=5">@lang('admin.orders_redirect_to_deliver')</a></li>
                                <li class="{{ request('status') == 6 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=6">@lang('admin.orders_delivered_success')</a></li>
                                <li class="{{ request('status') == 7 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=7">@lang('admin.orders_delivered_delay')</a></li>
                                <li class="{{ request('status') == 8 ? 'active': '' }}"><a href="{{ route('dashboard.deliveries.index') }}?status=8">@lang('admin.orders_delivered_cancelled')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#money_transfer" class="has-arrow"><i class="icon-bag"></i> <span>@lang('admin.money_transfer')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.commissions.index') }}?isPaid=1">@lang('admin.representative_commission_paid')</a></li>
                                <li><a href="{{ route('dashboard.commissions.index') }}?isPaid=0">@lang('admin.representative_commission_unpaid')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#LocalNotesDeliveries" class="has-arrow"><i class="icon-bag"></i> <span>@lang('admin.delivery_notes')</span></a>
                            <ul>
                                <li><a href="{{ route('dashboard.delivery_notes.index') }}">@lang('admin.delivery_notes')</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="tab-pane animated fadeIn" id="setting">
                <div class="p-l-15 p-r-15">
                    <h6>@lang('admin.choose_color')</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>@lang('admin.purple')</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>@lang('admin.blue')</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>@lang('admin.cyan')</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>@lang('admin.green')</span>
                        </li>
                        <li data-theme="orange" class="active">
                            <div class="orange"></div>
                            <span>@lang('admin.orange')</span>
                        </li>
                    </ul>
                    <hr>
                    <h6>@lang('admin.general_settings')</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>@lang('admin.email_direct')</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>@lang('admin.notifications')</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>@lang('admin.multi_vendor')</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
