<div class="sidebar" id="sidebar">
    <div class="modern-profile p-3 pb-0">

        <div class="sidebar-nav mb-3">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
                <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-header p-3 pb-0 pt-2">

        <div class="d-flex align-items-center justify-content-between menu-item mb-3">
            <div class="me-3">
                <a href="calendar.html" class="btn btn-icon border btn-menubar">
                    <i class="ti ti-layout-grid-remove"></i>
                </a>
            </div>
            <div class="me-3">
                <a href="chat.html" class="btn btn-icon border btn-menubar position-relative">
                    <i class="ti ti-brand-hipchat"></i>
                </a>
            </div>
            <div class="me-3 notification-item">
                <a href="activities.html" class="btn btn-icon border btn-menubar position-relative me-1">
                    <i class="ti ti-bell"></i>
                    <span class="notification-status-dot"></span>
                </a>
            </div>
            <div class="me-0">
                <a href="email.html" class="btn btn-icon border btn-menubar">
                    <i class="ti ti-message"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="clinicdropdown">
                    <a href="{{ route('viewProfile') }}">
                        <img src="{{ auth()->user()->profile_img_upload
            ? asset('storage/' . auth()->user()->profile_img_upload)
            : (auth()->user()->gender == 'Male'
                ? asset('assets/img/users/male.jpg')
                : asset('assets/img/users/female.jpg'))
        }}" class="img-fluid" alt="Profile">
                        <div class="user-names">
                            <h5>
                                {{ auth()->user()->gender == 'Male' ? 'Mr.' : 'Ms.' }}
                                {{ explode(' ', auth()->user()->employeeName)[0] }}
                                {{ explode(' ', auth()->user()->employeeName)[count(explode(' ', auth()->user()->employeeName)) - 2] }}
                            </h5>
                            <h6>{{ auth()->user()->grade }}</h6>
                        </div>
                    </a>


                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr">Main Menu</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? ' active' : '' }}">
                                <i class="ti ti-layout-2"></i><span>Dashboard</span><span class=""></span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ request()->routeIs(['categoryForm', 'categoryView', 'guidelinesForm', 'viewGuidelines', 'packageForm', 'viewPackage', 'viewVirtualNumbers', 'otpDetails', 'transferAccounts', 'assignJDLeads', 'notifications', 'paymentGateway', 'manageVMN']) ? 'subdrop active' : '' }}">
                                <i class="ti ti-brand-databricks"></i><span>Master's Menu</span><span
                                    class="menu-arrow"></span>
                            </a>
                            <ul>
                                <!-- Category Section -->
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="{{ request()->routeIs(['categoryForm', 'categoryView']) ? 'subdrop active' : '' }}">
                                        Category <span class="menu-arrow inside-submenu"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('categoryForm') }}"
                                                class="{{ request()->routeIs('categoryForm') ? 'active' : '' }}">Add
                                                New</a></li>
                                        <li><a href="{{ route('categoryView') }}"
                                                class="{{ request()->routeIs('categoryView') ? 'active' : '' }}">View/Update</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Package Section -->
                                <li
                                    class="submenu submenu-two {{ request()->routeIs(['packageForm', 'viewPackage']) ? 'active open' : '' }}">
                                    <a href="javascript:void(0);"
                                        class="{{ request()->routeIs(['packageForm', 'viewPackage']) ? 'subdrop active' : '' }}">
                                        Package Details <span class="menu-arrow inside-submenu"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('packageForm') }}"
                                                class="{{ request()->routeIs('packageForm') ? 'active' : '' }}">Add
                                                New</a></li>
                                        <li><a href="{{ route('viewPackage') }}"
                                                class="{{ request()->routeIs('viewPackage') ? 'active' : '' }}">View/Update</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Company Guidelines -->
                                <li
                                    class="submenu submenu-two {{ request()->routeIs(['guidelinesForm', 'viewGuidelines']) ? 'active open' : '' }}">
                                    <a href="javascript:void(0);"
                                        class="{{ request()->routeIs(['guidelinesForm', 'viewGuidelines']) ? 'subdrop active' : '' }}">
                                        Company Guidelines <span class="menu-arrow inside-submenu"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('guidelinesForm') }}"
                                                class="{{ request()->routeIs('guidelinesForm') ? 'active' : '' }}">Add
                                                Guidelines</a></li>
                                        <li><a href="{{ route('viewGuidelines') }}"
                                                class="{{ request()->routeIs('viewGuidelines') ? 'active' : '' }}">View
                                                Guidelines</a></li>
                                    </ul>
                                </li>

                                <!-- Virtual Numbers -->
                                <li
                                    class="submenu submenu-two {{ request()->routeIs(['manageVMN', 'viewVirtualNumbers']) ? 'active open' : '' }}">
                                    <a href="javascript:void(0);"
                                        class="{{ request()->routeIs(['manageVMN', 'viewVirtualNumbers']) ? 'subdrop active' : '' }}">
                                        Virtual Numbers <span class="menu-arrow inside-submenu"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('manageVMN') }}"
                                                class="{{ request()->routeIs('manageVMN') ? 'active' : '' }}">Add
                                                Virtual Number</a></li>
                                        <li><a href="{{ route('viewVirtualNumbers') }}"
                                                class="{{ request()->routeIs('viewVirtualNumbers') ? 'active' : '' }}">View
                                                Virtual Numbers</a></li>
                                    </ul>
                                </li>

                                <!-- OTP Requests -->
                                <li><a href="{{ route('otpDetails') }}"
                                        class="{{ request()->routeIs('otpDetails') ? 'active' : '' }}">OTP Requests</a>
                                </li>

                                <!-- Account Transfer -->
                                <li><a href="{{ route('transferAccounts') }}"
                                        class="{{ request()->routeIs('transferAccounts') ? 'active' : '' }}">Account
                                        Transfer</a></li>

                                <!-- JD Leads Assignment -->
                                <li><a href="{{ route('assignJDLeads') }}"
                                        class="{{ request()->routeIs('assignJDLeads') ? 'active' : '' }}">JD Leads
                                        Assignment</a></li>

                                <!-- Notifications -->
                                <li><a href="{{ route('notifications') }}"
                                        class="{{ request()->routeIs('notifications') ? 'active' : '' }}">Notifications</a>
                                </li>

                                <!-- Payment Gateway -->
                                <li><a href="{{ route('paymentGateway') }}"
                                        class="{{ request()->routeIs('paymentGateway') ? 'active' : '' }}">Payment
                                        Gateway</a></li>
                            </ul>
                        </li>






                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>