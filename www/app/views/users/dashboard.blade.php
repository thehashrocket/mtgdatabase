@extends('layouts.master')

@section('sidebar')
@parent

<p>Here's some radical sidebar content</p>

@stop

@section('content')

<div class="row">
    <div class="large-12 columns">
        <h1>Dashboard</h1>

        <p>Welcome to your Dashboard. You rock!</p>
    </div>
</div>
<div class="row">
    <div class="large-4 columns">
        <h3>Your Decks</h3>
        <?php var_dump($decks); ?>
    </div>
    <div class="large-8 columns">
        <h3>Your Cards</h3>
    </div>
</div>

@stop