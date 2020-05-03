<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ user()->name }} </div>
                <div class="email">{{ user()->email }}</div>
                <div class="email">10000</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="index.html">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <!-- LOAD PLUGIN SIDEBAR -->

                <!-- END PLUGIN SIDEBAR -->

                @if( user()->isAdmin() )
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Admin Settings</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/admin/users" >
                                    <span>User Manager</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Plugin Manager</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- LOAD ADMIN SETTING PLUGIN -->

                            @foreach(MenuManager::getAdminMenu() as $menu)
                                <li>

                                    <a href="{{ $menu->isToggleable() ? 'javascript:void(0);' : $menu->getUrl() }}" @if( $menu->isToggleable() ) class="menu-toggle" @endif>
                                        <i class="material-icons">{{ $menu->getIcon() }}</i>
                                        <span> {{ $menu->getName() }} </span>
                                    </a>

                                    @if( $menu->isToggleable() && $menu instanceof \App\Contracts\ToggleableSideMenu )

                                        <ul class="ml-menu">
                                            @foreach( $menu->getChilds() as $menuChild )
                                                <li>
                                                    <a href="{{ $menuChild->getUrl() }}"> {{ $menuChild->getName() }} </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </li>

                            @endforeach

                            <!-- END ADMIN SETTING PLUGIN -->
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 - {{ now()->format('Y') }} <a href="https://codester.com/rizalio">{{ panel_name() }} - by SSHPANEL</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
<!-- #END# Left Sidebar -->
</section>
