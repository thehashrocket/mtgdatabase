
@section('sidebar')
@parent

<div class="row">
    <div class="large-12 columns"><h4>Magic Card of the Moment</h4></div>
</div>
<div class="row">
    <div class="large-3 columns"><p><strong>Card Name:</strong></p></div>
    <div class="large-9 columns">{{ $card->name }}</div>
</div>
<div class="row">
    <div class="large-12 columns">
        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={{ $card->id }}&type=card" />
    </div>
</div>
@stop
