  <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ $APP_NAME }}</a>
        </div>       

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="/auth/login">Login</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav side-nav">
                {{-- <li>
                    <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li> --}}
                <li class="{{ strpos(Request::path(), 'transaction') !== false ? 'active' : '' }}">
                    <a href="/transaction"><i class="fa fa-fw fa-credit-card"></i> {{ $TRANS_TITLE }}</a>
                </li>                
                <li class="{{ strpos(Request::path(), 'person') !== false ? 'active' : '' }}">
                    <a href="/person"><i class="fa fa-fw fa-users"></i> {{ $PERSON_TITLE }}</a>
                </li>
                <li class="{{ strpos(Request::path(), 'market') !== false ? 'active' : '' }}">
                    <a href="/market"><i class="fa fa-fw fa-tasks"></i> {{ $MARKET_TITLE }}</a>
                </li>
                <li class="{{ strpos(Request::path(), 'item') !== false ? 'active' : '' }}">
                    <a href="/item"><i class="fa fa-fw fa-shopping-cart"></i> {{ $ITEM_TITLE }}</a>
                </li>                
                <li class="{{ strpos(Request::path(), 'user') !== false ? 'active' : '' }}">
                    <a href="/user"><i class="fa fa-fw fa-user"></i> {{ $USER_TITLE }}</a>
                </li>
                <li class="{{ strpos(Request::path(), 'campaign') !== false ? 'active' : '' }}">
                    <a href="/campaign"><i class="fa fa-fw fa fa-newspaper-o"></i> {{ $CAMPAIGN_TITLE }}</a>
                </li>
                <li class="{{ strpos(Request::path(), 'scheduler') !== false ? 'active' : '' }}">
                    <a href="/scheduler"><i class="fa fa-fw fa fa-clock-o"></i> {{ $SCHEDULER_TITLE }}</a>
                </li> 
                <li class="{{ strpos(Request::path(), 'report') !== false ? 'active' : '' }}">
                    <a href="/report"><i class="fa fa-fw fa fa-file-text-o"></i> {{ $REPORT_TITLE }}</a>
                </li>         
                <li class="{{ strpos(Request::path(), 'massemail') !== false ? 'active' : '' }}">
                    <a href="/massemail"><i class="fa fa-fw fa fa-envelope-o"></i> {{ $EMAIL_TITLE }}</a>
                </li>                                                                             
            </ul>
        </div>       
    </nav>