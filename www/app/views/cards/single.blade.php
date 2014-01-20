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
        <div id="card_image" class="clearfix"><img src="{{ $card_data->info->card_image }}" /></div>
    </div>
    <div class="columns small-7">
        <div id="card_data_wrapper" class="clearfix">

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Card Name:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->name }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Mana Cost:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->manacost }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Converted Mana Cost:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->converted_mana_cost }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Types:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->type }} &ndash; {{ $card_data->info->subtype }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Card Text:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->description }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">P/T:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->power }} / {{ $card_data->info->toughness }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Expansion:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->card_set_id }} {{ $card_data->info->card_set_name }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Rarity:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->rarity }}</div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <div class="card_label">Artist:</div>
                </div>
                <div class="small-8 columns">
                    <div class="card_text">{{ $card_data->info->artist }}</div>
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
        {{ Form::open( array( 'url' => '/single/update','class'=>'form-addcard' ) ) }}
        {{ Form::hidden( 'card_id', $card_data->id ) }}

        <div id="user_options" class="clearfix">

            <div class="row">
                <div class="small-3 columns">
                    <p>Condition:</p>
                </div>
                <div class="small-3 columns">

                    <select name="condition_id">
                        @foreach ($condition as $con)
                            <?php if($con->id == $card_data->condition_id) { $selected = "selected";} else { $selected = ""; } ?>
                        <option value="{{ $con->id }}" {{ $selected }}>{{ $con->description }}</option>
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
                    <?php $checked = ""; ?>

                        @foreach ($attributes as $check)
                            @foreach ($card_data->attributes as $attribute)
                                <?php
                                if ($check->id == $attribute->id) {
                                    $checked = 'checked';
                                } ?>
                            @endforeach
                        <input name="attributes[]" value="{{ $check->id }}" type="checkbox" {{ $checked }}><label for="attributes">{{ $check->alias }}</label><br/>
                            <?php $checked = ""; ?>
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
                            <?php if($deck->id == $card_data->deck_id) { $selected = "selected";} else { $selected = ""; } ?>
                        <option value="{{ $deck->id }}" {{ $selected }}>{{ $deck->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="small-6 columns">

                </div>
            </div>
            <div class="row">
                <div class="small-3 small-6 columns">
                    {{ Form::submit( 'Update', array( 'class' => 'button tiny' ) ) }}
                </div>
                <div class="small-3 small-6 columns"><a href="{{ $card_data->id }}" class="delete button tiny alert">Delete</a> </div>
                <div class="small-6 hide-for-small columns"></div>
            </div>

        </div>
        {{ Form::close() }}
    </div>
    <div class="columns small-1"><p></p></div>
</div>

@endif

@show
