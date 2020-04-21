<ul class="navbar-nav mr-auto">
    @auth('admin')
    @if (canAccess('categories.index'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
    </li>
    @endif
    @if (canAccess('products.index'))

    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">{{ __('Products') }}</a>
    </li>
    @endif

    @if(canAccess('customers.index'))

    <li class="nav-item">
        <a class="nav-link" href="{{route('customers.index')}}">{{__('Customers')}}</a>
    </li>
    
    @endif

    @if(canAccessAny(['admins.index','roles.index']))
    {{-- Employees dropdown --}}
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{__('Employees')}} <span class="caret"></span>

        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        
        @if (canAccess('admins.index'))
        <a class="dropdown-item" href="{{ route('admins.index') }}">{{ __('Admins') }}</a>
        @endif
        
        @if (canAccess('roles.index'))
        <a class="dropdown-item" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
        @endif

        </div>
    </li>
    @endif
    @endauth
</ul>