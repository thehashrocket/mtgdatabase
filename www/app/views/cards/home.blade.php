@section( 'title' )
@if( empty( $card_data ) )
<p>Nothing to see here.</p>
@endif
@show

@section('content')

@if( ! empty( $card_data ) )
<div class="row">

        @if( Auth::check() )
        <div class="columns small-9">

        </div>
        <div class="columns small-3">
            <a href="#" class="button tiny close">Close</a>
        </div>
        @else
        <div class="columns small-11">

        </div>
        <div class="columns small-1">
            <a class="close-reveal-modal button tiny">Close</a>
        </div>
        @endif
    </div>
</div>



<div class="row">
    <div class="columns small-3 small-offset-1">
        <div id="card_image" class="clearfix"><img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={{ $card_data->card_id }}&type=card" /></div>
    </div>
    <div class="columns small-7">
        <div id="card_data_wrapper" class="clearfix">

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Card Name:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->name }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Mana Cost:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->manacost }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Converted Mana Cost:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->converted_mana_cost }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Types:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->type }} &ndash; {{ $card_data->subtype }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Card Text:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->description }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">P/T:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->power }} / {{ $card_data->toughness }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Expansion:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->card_set_id }} {{ $card_data->card_set_name }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Rarity:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->rarity }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Artist:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->artist }}</div>
                </div>
            </div>
            <?php
            /*
                <div class="row">
                    <div class="small-4 columns">
                        <div class="card_label">Card Number:</div>
                    </div>
                    <div class="small-8 columns">
                        <div class="card_text">{{ $card_data->converted_mana_cost }}</div>
                    </div>
                </div>
            */
            ?>

        </div>
    </div>
    <div class="columns small-1"><p></p></div>
</div>




@endif

@if( Auth::check() )

<div class="row">
    <div class="columns small-10 small-offset-1">
        {{ Form::open( array( 'url' => '/single/create','class'=>'form-addcard' ) ) }}
        {{ Form::hidden( 'card_id', $card_data->id ) }}

        <div id="user_options" class="clearfix">
            <div class="row">
                <div class="small-3 columns">
                    <p>How many:</p>
                </div>
                <div class="small-3 columns">
                    <p>{{ Form::text( 'num_cards', '1', array( 'class' => 'numberbox' ) ) }}
                    </p>
                </div>
                <div class="small-6 columns">

                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <p>Condition:</p>
                </div>
                <div class="small-3 columns">

                    <select name="condition_id">
                        @foreach ($condition as $con)
                        <option value="{{ $con->id }}">{{ $con->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="small-6 columns">

                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <p>Attributes:</p>
                </div>
                <div class="small-4 columns">

                        @foreach ($attributes as $check)
                        <input name="attributes[]" value="{{ $check->id }}" type="checkbox"><label for="attributes">{{ $check->alias }}</label><br/>
                        @endforeach

                </div>
                <div class="small-5 columns">

                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <p>Add To Deck:</p>
                </div>
                <div class="small-3 columns">

                    <select name="deck_id">
                        <option value="">None</option>
                        @foreach ($decks as $deck)
                        <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="small-6 columns">

                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    {{ Form::submit( 'Add This Card', array( 'class' => 'button tiny' ) ) }}
                </div>
                <div class="small-9 columns"></div>
            </div>

        </div>
        {{ Form::close() }}
    </div>
    <div class="columns small-1"><p></p></div>
</div>

@endif

@show
