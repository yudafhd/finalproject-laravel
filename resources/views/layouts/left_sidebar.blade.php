<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        {{-- <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <img src="../assets/images/users/profile.png" alt="user" /><span class="hide-menu">{{$user->name}} </span></a>
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
                        {{-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/dashboard">Main </a></li>
                            </ul>
                        </li> --}}
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('user')}}">List</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Customer</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('customers.create')}}">Create</a></li>
                            <li><a href="{{Route('customers.index')}}">List</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Paket</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('package.create')}}">Create</a></li>
                            <li><a href="{{Route('package.index')}}">List</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Booking</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{Route('booking.create')}}">Create</a></li>
                            <li><a href="{{Route('booking.index')}}">List</a></li>
                            <li><a href="{{Route('booking.cancel')}}">Cancel</a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>