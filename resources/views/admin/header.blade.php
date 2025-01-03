<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="" href="./"><span style="font-style: italic"><strong>Wijoyo
                        Mebel</strong></span></a>
            {{-- <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a> --}}
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="/frontend/admin_frontend/elaadmin/images/admin.jpg"
                        alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa- user"></i>{{ auth()->user()->email }}</a>

                    {{-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span
                            class="count">13</span></a>

                    <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> --}}

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link text-danger"
                            onclick="event.preventDefault();
                    this.closest('form').submit();"
                            href="{{ route('logout') }}"><i class="fa fa-power -off"></i>Logout</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

<style>
    .fl-wrapper {
        z-index: 9999;
    }
</style>
