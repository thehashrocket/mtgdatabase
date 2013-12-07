<!-- Stored in app/views/layouts/master.blade.php -->

<html>
{{ stylesheet_link_tag() }}
{{ javascript_include_tag($manifestFile = 'head') }}
<body>
<div class="row">
    <div class="large-12 columns">
        <h1>Welcome to the MTG Database</h1>
        <h3>Your One Stop Shop for organising and researching your Magic: The Gathering cards.</h3>
    </div>
</div>

    <div class="row">
        <div class="contain-to-grid sticky">
            <nav class="top-bar" data-topbar>
                <ul class="title-area">
                    <li class="name">
                        <h1><a href="#">MTG Database</a></h1>
                    </li>
                    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                </ul>

                <section class="top-bar-section">
                    <!-- Right Nav Section -->
                    <ul class="right">
                        <li class="has-dropdown">
                            <a href="#">Users</a>
                            <ul class="dropdown">
                                @if(!Auth::check())
                                    <li>{{ HTML::link('users/register', 'Register') }}</li>
                                    <li>{{ HTML::link('users/login', 'Login') }}</li>
                                @else
                                    <li>{{ HTML::link('users/logout', 'logout') }}</li>
                                @endif
                            </ul>
                        </li>
                    </ul>

                    <!-- Left Nav Section -->
                    <ul class="left">
                        <li><a href="/">Home</a></li>
                    </ul>
                </section>
            </nav>
        </div>
    </div>

<div class="row">
    <div class="large-3 columns hide-for-medium-down">
        @section('sidebar')

        @include('widgets.sidebar_cards')
        @show
    </div>
    <div class="large-9 columns">
        @yield('content')
    </div>
</div>

<div class="container">
    @if(Session::has('message'))
        <p class="alert">{{ Session::get('message') }}</p>
    @endif
</div>

{{ javascript_include_tag($manifestFile = 'application') }}
</body>
</html>