<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li> <a href="{{Route('admin.dashboard')}}">
                            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        @if (auth()->user()->access_type ==='superadmin' ||  auth()->user()->can('users'))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('admin.user.list', 'admin')}}">Admin</a></li>
                                <li><a href="{{Route('admin.user.list', 'general')}}">General</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->access_type ==='superadmin' ||  auth()->user()->can('products'))
                            <li> <a href="{{Route('admin.product.index')}}">
                            <i class="mdi mdi-package-variant-closed"></i><span class="hide-menu">Product</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->access_type ==='superadmin' ||  auth()->user()->can('themes'))
                            <li> <a href="{{Route('admin.theme.index')}}">
                            <i class="mdi mdi-brush"></i><span class="hide-menu">Theme</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->access_type ==='superadmin' ||  auth()->user()->can('settings'))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('admin.role.list')}}">Roles</a></li>
                                <li><a href="{{Route('admin.permission.list')}}">Permissions</a></li>
                            </ul>
                        </li>
                       @endif
                     
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>