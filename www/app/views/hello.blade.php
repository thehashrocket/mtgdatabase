@extends('layouts.master')

@section('sidebar')
@parent

@stop

@section('content')


    <div class="row">
        <div class="large-12 columns">
            <div class="panel">
                <h3>Welcome to the MTG Database</h3>
                <p>Now you can organise, buy and sell your magic cards and take your info wherever you go!</p>
                <p>Our site works equally well on desktop and mobile! When you're at FNM you can easily pull up your decks, look up prices and all right from your phone or tablet!</p>
                <p>Are you ready to find out more? You should check out:</p>
                <div class="row">
                    <div class="large-4 medium-4 columns">
                        @if(!Auth::check())
                            <p><a href="http://foundation.zurb.com/docs">Become A Member</a><br />Becoming a member is FREE! You get access your to cards anywhere you have Internet access.</p>

                            <p>{{ HTML::link('users/register', 'Register') }} | {{ HTML::link('users/login', 'Login') }}</p>

                        @else
                            <p><a href="http://foundation.zurb.com/docs">You're Already A Member!</a><br />Thank you for being a member. We appreciate you!</p>

                        @endif

                    </div>
                    <div class="large-4 medium-4 columns">
                        <p><a href="http://github.com/zurb/foundation">Foundation on Github</a><br />Latest code, issue reports, feature requests and more.</p>
                    </div>
                    <div class="large-4 medium-4 columns">
                        <p><a href="http://twitter.com/foundationzurb">@foundationzurb</a><br />Ping us on Twitter if you have questions. If you build something with this we'd love to see it (and send you a totally boss sticker).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop