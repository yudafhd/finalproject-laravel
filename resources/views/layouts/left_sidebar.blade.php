<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        {{-- <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <img src="../assets/images/users/profile.png" alt="user" /><span class="hide-menu">{{auth()->user()->name}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void()">My Profile </a></li>
                                <li><a href="javascript:void()">My Balance</a></li>
                                <li><a href="javascript:void()">Inbox</a></li>
                                <li><a href="javascript:void()">Account Setting</a></li>
                                <li><a href="javascript:void()">Logout</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-devider"></li> --}}
                        {{-- <li class="nav-small-cap">PERSONAL</li> --}}
                        
                        @if (auth()->user()->type ==='superadmin' || in_array('menu dashboard',auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/dashboard">Main </a></li>
                            </ul>
                        </li>
                        @endif
                    
                        @if (auth()->user()->type ==='superadmin' ||  in_array('menu users', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/user/admin')}}">Admin</a></li>
                                <li><a href="{{url('/user/guru')}}">Guru</a></li>
                                <li><a href="{{url('/user/siswa')}}">Siswa</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' ||  in_array('menu settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('absents.index')}}">
                            <i class="mdi mdi-checkbox-marked-outline"></i><span class="hide-menu">Absensi</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->type ==='superadmin' ||  in_array('menu settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('role.list')}}">
                            <i class="mdi mdi-school"></i><span class="hide-menu">Kelas</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->type ==='superadmin' ||  in_array('menu settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('role.list')}}">
                            <i class="mdi mdi-book-open"></i><span class="hide-menu">Mata Pelajaran</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->type ==='superadmin' ||  in_array('menu settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('role.list')}}">
                            <i class="mdi mdi-calendar-clock"></i><span class="hide-menu">Jadwal</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->type ==='superadmin' ||  in_array('menu settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-box"></i><span class="hide-menu">Settings</span></a>
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