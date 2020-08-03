<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li> <a href="{{Route('admin.dashboard')}}">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        @if (auth()->user()->access_type ==='superadmin' ||  in_array('users', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @if (auth()->user()->access_type ==='superadmin')
                                <li><a href="{{Route('admin.user.list', 'admin')}}">Admin</a></li>
                                @endif
                                @if (auth()->user()->access_type ==='superadmin' ||  in_array('users', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                                <li><a href="{{Route('admin.user.list', 'general')}}">General</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        {{-- @if (auth()->user()->access_type ==='superadmin' ||  in_array('product', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                            <li> <a href="{{Route('admin.product.index')}}">
                            <i class="mdi mdi-settings-box"></i><span class="hide-menu">Product</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->access_type ==='superadmin' ||  in_array('theme', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-settings-box"></i><span class="hide-menu">Theme</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('admin.dashboard')}}">general</a></li>
                            </ul>
                        </li>
                       @endif
                        @if (auth()->user()->access_type ==='superadmin' ||  in_array('transaction', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-settings-box"></i><span class="hide-menu">Transaction</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('admin.dashboard')}}">Transaction List</a></li>
                                <li><a href="{{Route('admin.dashboard')}}">User map transaction</a></li>
                            </ul>
                        </li>
                       @endif
                        @if (auth()->user()->access_type ==='superadmin' ||  in_array('master', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-settings-box"></i><span class="hide-menu">Master</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('admin.dashboard')}}">link icon name</a></li>
                                <li><a href="{{Route('admin.dashboard')}}">content setting</a></li>
                            </ul>
                        </li>
                       @endif --}}
                        @if (auth()->user()->access_type ==='superadmin' ||  in_array('settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-box"></i><span class="hide-menu">Settings</span></a>
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