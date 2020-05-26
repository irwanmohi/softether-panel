<div class="user-info">
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ $name }} </div>
        <div class="email">{{ $email }}</div>
        <div class="email">{{ $balance }}</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="{{ route('me') }}"><i class="material-icons">person</i>Account Setting</a></li>
                <li role="separator" class="divider"></li>
                <li><a onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    href="{{ route('logout') }}"><i class="material-icons">input</i>Sign Out</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</div>
