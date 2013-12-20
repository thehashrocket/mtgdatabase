@section( 'title' )
@if( empty( $card_data ) )
<h4>Your Cards</h4>
@endif
@show

@section('content')

@if( ! empty( $card_data ) )

<div class="row">
    <div class="columns large-4">
        <div id="card_image" class="clearfix"><img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={{ $card_data->card_id }}&type=card" /></div>
    </div>
    <div class="columns large-8">
        <div id="card_data_wrapper" class="clearfix">

            <div id="card_data" class="clearfix">

                <div id="card_name">
                    <div class="card_label">Card Name:</div>
                    <div class="card_text">{{ $card_data->name }}</div>
                </div>

                <div id="card_cost">
                    <div class="card_label">Mana Cost:</div>
                    <div class="card_text">{{ $card_data->manacost }}</div>
                </div>

                <div id="card_converted_cost">
                    <div class="card_label">Converted Mana Cost:</div>
                    <div class="card_text">{{ $card_data->converted_mana_cost }}</div>
                </div>

                <div id="card_types">
                    <div class="card_label">Types:</div>
                    <div class="card_text">{{ $card_data->type }} &ndash; {{ $card_data->subtype }}</div>
                </div>

                <div id="card_text">
                    <div class="card_label">Card Text:</div>
                    <div class="card_text">{{ $card_data->description }}</div>
                </div>

                <div id="card_pt">
                    <div class="card_label">P/T:</div>
                    <div class="card_text">{{ $card_data->power }} / {{ $card_data->toughness }}</div>
                </div>

                <div id="card_expansion">
                    <div class="card_label">Expansion:</div>
                    <div class="card_text">{{ $card_data->card_set_id }} {{ $card_data->card_set_name }}</div>
                </div>

                <div id="card_rarity">
                    <div class="card_label">Rarity:</div>
                    <div class="card_text">{{ $card_data->rarity }}</div>
                </div>
                <?php
                /*
                            <div id="card_number">
                                <div class="card_label">Card Number:</div>
                                <div class="card_text">{{ $card_data->converted_mana_cost }}</div>
                            </div>
                */
                ?>

                <div id="card_artist">
                    <div class="card_label">Artist:</div>
                    <div class="card_text">{{ $card_data->artist }}</div>
                </div>

            </div>

        </div>
    </div>
</div>




@endif

@if( Auth::check() )

<div class="row">
    <div class="columns large=12">
        {{ Form::open( array( 'url' => '/single/create','class'=>'form-addcard' ) ) }}
        {{ Form::hidden( 'card_id', $card_data->id ) }}
        <div id="user_options" class="clearfix">
            <div class="row">
                <div class="large-6 columns">
                    <p>How many:</p>
                </div>
                <div class="large-6 columns">
                    <p>{{ Form::text( 'num_cards', '1', array( 'class' => 'numberbox' ) ) }} {{ Form::submit( 'Add This Card', array( 'class' => 'btn btn-default btn-sm' ) ) }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <p>Condition:</p>
                </div>
                <div class="large-6 columns">

                </div>
            </div>




        </div>
        {{ Form::close() }}
    </div>
</div>



@endif

@show
