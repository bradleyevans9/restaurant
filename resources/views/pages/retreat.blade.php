@extends('template')
@section('content')
<h1>Welcome to the Montserrat Retreat House Database!</h1>
<p>This is the retreat page. You will be able to create a retreat and see a list of the retreats from where you can edit or delete existing retreats.</p>
<p>
    <a href={{ action([\App\Http\Controllers\RetreatController::class, 'create']) }}>{!! Html::image('images/create.png', 'Create a Retreat',array('title'=>"Create Retreat")) !!}</a></li>
    <a href={{ action([\App\Http\Controllers\RetreatController::class, 'index']) }}>{!! Html::image('images/index.png', 'Index of Retreats',array('title'=>"Retreat Index")) !!}</a></li>
</p>

@stop
