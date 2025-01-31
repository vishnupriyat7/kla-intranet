<aside id="sidebar" class="sidebar-toggle">
    <div class="sidebar-logo">
        <a href="#">KLA INTRANET</a>
    </div>
    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav p-0">
        {{-- <li class="sidebar-header">
            Tools & Components
        </li> --}}
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('periodicals.index') }}" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Periodicals</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('news-updates.index') }}" class="sidebar-link">
                <i class="ri ri-news-line"></i>
                <span>News/Upadtes</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-agenda"></i>
                <span>Task</span>
            </a>
        </li>
        {{-- <li class="sidebar-header">
            Pages
        </li> --}}
        {{-- <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#auth" aria-expanded="true" aria-controls="auth">
                <i class="lni lni-protection"></i>
                <span>Auth</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Login</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Register</a>
                </li>
            </ul>
        </li> --}}
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#settings" aria-expanded="true" aria-controls="settings">
                <i class="lni lni-protection"></i>
                <span>Settings</span>
            </a>
            <ul id="settings" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('periodical-masters.index') }}" class="sidebar-link"> <i
                            class="lni lni-agenda"></i>Periodical Items</a>
                </li>
                {{-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Register</a>
                </li> --}}
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-popup"></i>
                <span>Notification</span>
            </a>
        </li>
        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')" class="sidebar-link"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="lni lni-exit"></i>
                    <span>Log Out</span>
                </a>

            </form>
        </li>



    </ul>
    <!-- Sidebar Navigation Ends -->
    {{-- <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Setting</span>
        </a>
    </div> --}}

</aside>
