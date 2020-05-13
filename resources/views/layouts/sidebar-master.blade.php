@php
    event(new \App\Events\Dashboard\SidebarLoading);
@endphp

<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->

        @livewire('user-sidebar-info', ['user' => user()])

        <!-- #User Info -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="@if(request()->url() == url('/')) active @endif">
                    <a href="/">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>

                <!-- LOAD PLUGIN SIDEBAR -->

                @foreach(MenuManager::getMenu() as $menu)
                    <li class="@if($menu->isActive()) active @endif">

                        <a href="{{ $menu->isToggleable() ? 'javascript:void(0);' : $menu->getUrl() }}" @if( $menu->isToggleable() ) class="menu-toggle" @endif>
                            <i class="material-icons">{{ $menu->getIcon() }}</i>
                            <span> {{ $menu->getName() }} </span>
                        </a>

                        @if( $menu->isToggleable() && $menu instanceof \App\Contracts\ToggleableSideMenu )

                            <ul class="ml-menu @if($menu->isActive()) active @endif">
                                @foreach( $menu->getChilds() as $menuChild )
                                    <li>
                                        <a href="{{ $menuChild->getUrl() }}" > {{ $menuChild->getName() }} </a>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </li>

                @endforeach

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
                                        <a href="/admin/plugins">All Plugins</a>
                                    </li>
                                    <li>
                                        <a href="/admin/plugins/create" data-turbolinks="false">Install New Plugin</a>
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
        <div class="legal bg-deep-purple">
            <div class="copyright " >
                &copy; 2018 - {{ now()->format('Y') }} <a style="color: #fff!important" href="https://codester.com/rizalio">{{ panel_name() }} - by SSHPANEL</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
<!-- #END# Left Sidebar -->
</section>
