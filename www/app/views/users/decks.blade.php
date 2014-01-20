@extends('layouts.master')

@section('sidebar')
@parent

<p>Here's some radical sidebar content</p>

@stop

@section('content')
<?php if ($authorized == true) { ?>
    <div class="row">
        <div class="small-12 columns">
            <h1>Manage Your Decks</h1>

            <p>Here you can manage your decks by adding and removing cards. You can also share this deck with others by using your unique url above.</p>
        </div>
    </div>
<?php } ?>

<div class="row">
    <?php if ($authorized == true) { ?>
        <div id="decksList" class="large-4 columns">


            <?php if (isset($decks) && count($decks) >= 1) { ?>

                <h3>Your Decks</h3>

                <?php foreach ($decks as $deck) { ?>
                    <div class="row">
                        <div class="small-4 columns"><a href="<?php echo $deck->id; ?>" class="deckDelete <?php echo $deck->id; ?> button alert tiny">Delete</a> </div>
                        <div class="small-8 columns">
                            <p><a class="deck" data-deck="<?php echo $deck->id; ?>" href="/decks/<?php echo $deck->id; ?>"><?php echo $deck->name; ?></a> </p>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>
            <div class="row">
                <div class="small-12 columns">
                    <h6>Create A Deck</h6>
                    {{ Form::open(array('url' => 'decks/create', 'class' => 'form-createdeck')) }}
                    {{ Form::text('deckName', null, array('class'=>'input-block-level', 'placeholder'=>'My Awesome Deck')) }}
                    {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary btn-block'))}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($authorized == true) { ?>

        <div class="large-8 columns">

           <div class="row">
               <div class="small-12 column">
                   <h3>Your Cards</h3>
                   <div class="row">
                       <div class="large-12 columns">
                           <p>Add Cards to Deck</p>
                           {{ Form::text( 'search', '', array( 'id' => 'search', 'class' => 'search-query span2', 'placeholder' => 'Search Database' ) ) }}
                       </div>
                   </div>
                   <div class="row">
                       <div class="small-12 columns">
                           <?php if ($authorized == true) {
                               ?>
                               <div id="addCard" class="">

                               </div>
                           <?php } ?>
                           <div id="results"></div>
                       </div>
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="small-12 columns">
                    <h3>Cards In This Deck</h3>
                </div>
            </div>

            <div id="cardsList" class="ul1">
                <?php if (isset($cards) && $cards != 0) { ?>

                    @foreach ($cards as $single)

                    <div class="row singlecard">
                        <a class="" href="{{ $single->id }}">
                            <div class="small-2 columns">
                                <img src="{{ $single->info->card_image }}">
                            </div>

                            <div class="small-10 columns">

                                <div class="row">
                                    <div class="small-12 columns"><p>{{ $single->info->name }}</p></div>
                                </div>
                                <div class="row">
                                    <div class="small-12 columns attributes">
                                        <p>
                                            @foreach ($single->attributes as $attribute)
                                            {{ $attribute->alias }}
                                            @endforeach
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>

                    @endforeach

                <?php } ?>
            </div>

        </div>

    <?php } else { ?>
        <div class="small-12 columns">

            <h3>{{ $owner->firstname }}'s {{ $deck->name }} Deck</h3>
        </div>
        <div id="cardsList" class="ul2">
            <?php if (isset($cards) && $cards != 0) { ?>

                @foreach ($cards as $single)

                <div class="row singlecard">
                    <a class="" href="{{ $single->id }}">
                        <div class="large-2 columns">
                            <img src="{{ $single->info->card_image }}">
                        </div>

                        <div class="small-10 columns">

                            <div class="row">
                                <div class="small-12 columns"><p>{{ $single->info->name }}</p></div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns attributes">
                                    <p>
                                        @foreach ($single->attributes as $attribute)
                                        {{ $attribute->alias }}
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>

                @endforeach

            <?php } ?>
        </div>
        <div id="addCard" class="reveal-modal" data-reveal>

        </div>
    <?php } ?>



</div>

@stop