<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest('admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
        </li>
       
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ route('admins.edit',['admin'=>Auth::guard('admin')->user()->id]) }}">{{ __('My info') }}</a>

                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul> 