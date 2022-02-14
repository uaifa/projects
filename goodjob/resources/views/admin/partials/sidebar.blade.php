 <!-- Sidebar-->
 <div class="border-end" id="sidebar-wrapper">
    <button class="btn-sidenav" id="sidebarToggle">
        <img src="{{ asset('assets/images/nav-arrow.png') }}">
    </button>
    <div class="sidebar-heading">
        <img src="{{ asset('assets/images/Logo.png') }}">
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action navemp" href="{{ route('staff-members.index') }}">
            <img src="{{ asset('assets/images/icon-nav-employee.png') }}"> 
            @lang('messages.staff_members')
        </a>
        {{-- {{ route('joblists.index') }} --}}
        <a class="list-group-item list-group-item-action navjobs" href="#!">
            <img src="{{ asset('assets/images/icon-nav-jobs.png') }}"> 
            @lang('messages.jobs')
        </a>
        <a class="list-group-item list-group-item-action navshed" href="#!">
            <img src="{{ asset('assets/images/icon-nav-scheduler.png') }}"> 
            @lang('messages.scheduler')
        </a>
        <a class="list-group-item list-group-item-action" href="{{ route('clients.index') }}">
            <img src="{{ asset('assets/images/icon-nav-customers.png') }}"> 
            @lang('messages.clients')
        </a>
        {{-- {{ route('places.index') }} --}}
        <a class="list-group-item list-group-item-action" href="#!">
            <img src="{{ asset('assets/images/icon-nav-places.png') }}"> 
            @lang('messages.places')
        </a>
        <a class="list-group-item list-group-item-action" href="{{ route('packages.index') }}">
            <img src="{{ asset('assets/images/packages.png') }}"> 
            @lang('messages.packages')
        </a>
        <a class="list-group-item list-group-item-action" href="{{ route('teams.index') }}">
            <img src="{{ asset('assets/images/teams.png') }}"> 
            @lang('messages.teams')
        </a>
        <a class="list-group-item list-group-item-action" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt" style="margin-right: 13px;"></i>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                style="display: none;">
                @csrf
            </form>
            logout
        </a>
    </div>
</div>