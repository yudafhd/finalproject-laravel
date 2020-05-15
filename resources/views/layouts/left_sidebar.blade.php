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
                        
                        {{-- @if (auth()->user()->type ==='superadmin' || in_array('menu dashboard',auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/dashboard">Main </a></li>
                            </ul>
                        </li>
                        @endif --}}
                        {{-- <li> <a href="/">
                            <i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li> --}}
                        {{-- @if (auth()->user()->level ==='superadmin' ||  in_array('menu users', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/user/admin')}}">Admin</a></li>
                                <li><a href="{{url('/user/guru')}}">Guru</a></li>
                                <li><a href="{{url('/user/siswa')}}">Siswa</a></li>
                            </ul>
                        </li>
                        @endif --}}
                        <li> <a href="{{Route('okp.index')}}">
                            <i class="mdi mdi-checkbox-marked-outline"></i><span class="hide-menu">Data OKP</span></a>
                        </li>
                        @if (auth()->user()->level ==='superadmin' ||  in_array('menu kegiatan', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('kegiatan.index')}}">
                            <i class="mdi mdi-checkbox-marked-outline"></i><span class="hide-menu">Data Kegiatan</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->level ==='superadmin' ||  in_array('menu anggota', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('anggota.index')}}">
                            <i class="mdi mdi-checkbox-marked-outline"></i><span class="hide-menu">Data Anggota</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->level ==='superadmin' ||  in_array('menu bidang', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a href="{{Route('bidang.index')}}">
                            <i class="mdi mdi-checkbox-marked-outline"></i><span class="hide-menu">Bidang</span></a>
                        </li>
                       @endif
                        @if (auth()->user()->level ==='superadmin' ||  in_array('menu settings', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-box"></i><span class="hide-menu">Settings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @if (auth()->user()->level ==='superadmin' ||  in_array('menu user', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                                <li><a href="{{Route('user.list')}}">User</a></li>
                                @endif
                                @if (auth()->user()->level ==='superadmin' ||  in_array('menu roles', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                                <li><a href="{{Route('role.list')}}">Roles</a></li>
                                @endif
                                @if (auth()->user()->level ==='superadmin' ||  in_array('menu permissions', auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                                <li><a href="{{Route('permission.list')}}">Permissions</a></li>
                                @endif
                            </ul>
                        </li>
                       @endif
                     
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>