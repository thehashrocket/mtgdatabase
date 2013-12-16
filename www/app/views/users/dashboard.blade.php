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

        <?php if (isset($decks)) { ?>

            <?php foreach ($decks as $deck) { ?>
                <div class="row">
                    <div class="large-12 columns">
                        <p><a href="decks/<?php echo $deck->user_id;?>/<?php echo $deck->id; ?>"><?php echo $deck->name; ?></a> </p>
                    </div>
                </div>
            <?php } ?>

        <?php } ?>
        <div class="row">
            <div class="large-12 columns">
                <a href="/users/decks">Manage Decks</a>
            </div>
        </div>
    </div>
    <div class="large-8 columns">
        <h3>Your Cards</h3>
    </div>
</div>

@stop