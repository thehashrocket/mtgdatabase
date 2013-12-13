@extends('layouts.master')

@section('sidebar')
@parent

<p>Here's some radical sidebar content</p>

@stop

@section('content')

<div class="row">
    <div class="large-12 columns">
        <h1>Your Decks</h1>

        <p>Create your Decks</p>
    </div>
</div>
<div class="row">
    <div class="large-4 columns">
        <h3>Your Decks</h3>

        <?php if (isset($decks->id)) { ?>

            @for ($i =0; $i < count($decks) - 1; $i++)
                <div class="row">
                    <div class="large-12 columns">
                        Deck is {{$decks[$i]}}
                    </div>
                </div>
            @endfor

        <?php } ?>
        <div class="row">
            <div class="large-12 columns">
                <h6>Create A Deck</h6>
                {{ Form::open(array('url' => 'foo/bar')) }}
                {{ Form::text('deckName', null, array('class'=>'input-block-level', 'placeholder'=>'My Awesome Deck')) }}
                {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="large-8 columns">
        <h3>Your Cards</h3>
    </div>
</div>

@stop