@extends('layouts.master')

@section('sidebar')
@parent

<p>Here's some radical sidebar content</p>

@stop

@section('content')
<?php if ($authorized == true) { ?>
    <div class="row">
        <div class="large-12 columns">
            <h1>Manage Your Decks</h1>

            <p>Here you can manage your decks by adding and removing cards. You can also share this deck with others by using your unique url above.</p>
        </div>
    </div>
<?php } ?>
<div class="row">
    <?php if ($authorized == true) { ?>
        <div class="large-4 columns">


            <?php if (isset($decks) && count($decks) >= 1) { ?>

                <h3>Your Decks</h3>

                <?php foreach ($decks as $deck) { ?>
                    <div class="row">
                        <div class="large-12 columns">
                            <p><a href="/decks/<?php echo $deck->id; ?>/<?php echo $deck->user_id;?>"><?php echo $deck->name; ?></a> </p>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>
            <div class="row">
                <div class="large-12 columns">
                    <h6>Create A Deck</h6>
                    {{ Form::open(array('url' => 'decks/create', 'class' => 'form-createdeck')) }}
                    {{ Form::text('deckName', null, array('class'=>'input-block-level', 'placeholder'=>'My Awesome Deck')) }}
                    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($authorized == true) { ?>
        <div id="myModal" class="reveal-modal"></div>
        <div class="large-8 columns">
           <div class="row">
               <div class="large-12 column">
                   <h3>Your Cards</h3>
                   <div class="row">
                       <div class="large-12 columns">
                           <p>Add Cards to Deck</p>
                           {{ Form::text( 'search', '', array( 'id' => 'search', 'class' => 'search-query span2', 'placeholder' => 'Search Database' ) ) }}
                       </div>
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="large-12 columns">
                    <h3>Cards In This Deck</h3>
                </div>
            </div>

        </div>

    <?php } else { ?>
        <div class="large-12 columns">
            <h3>Player Names Cards</h3>
        </div>
    <?php } ?>



</div>

@stop