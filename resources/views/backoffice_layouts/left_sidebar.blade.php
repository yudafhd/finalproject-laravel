<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li> <a href="{{Route('dashboard')}}">
                            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        @if (auth()->user()->type ==='superadmin' ||  auth()->user()->can('users'))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i>
                        <span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('user.list', 'admin')}}">Admin</a></li>
                                <li><a href="{{Route('user.list', 'guru')}}">Guru</a></li>
                                <li><a href="{{Route('user.list', 'siswa')}}">Siswa</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' ||  auth()->user()->can('settings'))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('role.list')}}">Roles</a></li>
                                <li><a href="{{Route('permission.list')}}">Permissions</a></li>
                            </ul>
                        </li>
                       @endif
                     
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>