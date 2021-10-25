<aside>
    <div class="sidenav-wrapper">
        <div class="toppart">
            <ul>
                {{-- <li><a href=""> <img src="{{ URL::asset("img/dashboard.svg") }}" alt=""> Dashboard</a></li> --}}
                <li class="{{ Request::routeIs('topics') ? 'menu-active' : '' }}"><a href="{{ route('topics') }}">
                        <img src="{{ URL::asset('img/message.svg') }}" alt="">
                        Topics</a></li>
                <li class="{{ Request::routeIs('questions') ? 'menu-active' : '' }}"><a
                        href="{{ route('questions') }}">
                        <img src="{{ URL::asset('img/qestions.svg') }}" alt="">
                        Questions</a></li>
                <li class="{{ Request::routeIs('advisor') ? 'menu-active' : '' }}"><a href="{{ route('advisor') }}">
                        <img src="{{ URL::asset('img/people.svg') }}" alt="">
                        Advisors</a></li>
                <li class="{{ Request::routeIs('audio.index') ? 'menu-active' : '' }}"><a
                        href="{{ route('audio.index') }}"> <img src="{{ URL::asset('img/qlips.svg') }}" alt="">
                        Audio
                        Qlips</a></li>
            </ul>
        </div>
        <div class="bottom-part">
            <p>Settings</p>
            <ul>
                <li><a href=""><img src="{{ URL::asset('img/settings.svg') }}" alt="">Main Settings</a></li>
                <li><a href=""><img src="{{ URL::asset('img/notifications.svg') }}" alt="">Notifications</a></li>
            </ul>
        </div>
    </div>
</aside>
