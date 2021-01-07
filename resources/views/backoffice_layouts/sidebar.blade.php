<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                {{-- <li>
                    <a href="{{Route('dashboard')}}">
                        <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li> --}}
                {{-- @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users'))
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-box"></i>
                        <span class="hide-menu">Users</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users admin'))
                        <li><a href="{{Route('user.list', 'admin')}}">admin</a></li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users siswa'))
                        <li><a href="{{Route('user.list', 'guru')}}">guru</a></li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users guru'))
                        <li><a href="{{Route('user.list', 'siswa')}}">siswa</a></li>
                        @endif
                    </ul>
                </li>
                @endif --}}
                @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users'))
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-database"></i>
                        <span class="hide-menu">Master Data</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users admin'))
                        <li><a href="{{Route('user.list', 'admin')}}">admin</a></li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users siswa'))
                        <li><a href="{{Route('user.list', 'guru')}}">guru</a></li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('users guru'))
                        <li><a href="{{Route('user.list', 'siswa')}}">siswa</a></li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('subjects'))
                        <li><a href="{{Route('subject.index')}}">
                                <span class="hide-menu">
                                    Mata Pelajaran
                                </span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->type ==='superadmin' || auth()->user()->can('classes'))
                        <li><a href="{{Route('kelas.index')}}">
                                <span class="hide-menu">
                                    Kelas
                                </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (auth()->user()->type ==='superadmin' || auth()->user()->can('absents'))
                <li>
                    <a href="{{Route('absent.index')}}"><i class="mdi mdi-check-circle-outline"></i>
                        <span class="hide-menu">
                            Absents
                        </span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->type ==='superadmin' || auth()->user()->can('schedules'))
                <li><a href="{{Route('schedule.index')}}"><i class="mdi mdi-calendar-check"></i>
                        <span class="hide-menu">
                            Jadwal
                        </span>
                    </a></li>
                @endif
                @if (auth()->user()->type ==='superadmin' || auth()->user()->can('settings'))
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
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