
@section('sidebar')
@parent

<?php if (isset($card->name)) { ?>

    <div class="row">
        <div class="large-12 columns"><h4>Magic Card of the Moment</h4></div>
    </div>
    <div class="row">
        <div class="large-12 columns"><h6>Card Name:</h6></div>
    </div>
    <div class="row">
        <div class="large-12 columns"><p>{{ $card->name }}</p></div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={{ $card->id }}&type=card" />
        </div>
    </div>

<?php } ?>
@stop
