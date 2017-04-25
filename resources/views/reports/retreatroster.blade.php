@extends('report')
@section('content')

<div class ="retreatroster">
@if (!$registrations->isEmpty())

<h2>Retreat #{{$registrations[0]->retreat->idnumber}} Room Roster - {{$registrations[0]->retreat->title}}</h2> 
     
<hr />
 <table width="100%">
     <tr>
        <th class="row-1 row-name" style='width: 25%'>Full name</th>
        <th class="row-2 row-note" style='width: 35%'>Notes</th>
        <td align='center' class="row-3 row-room" style='width: 20%'><strong>Assigned Room</strong></td>
        <th class="row-4 row-room_preference" style='width: 20%'>Room Preference</th>
     <tr>   
    @foreach($registrations as $registration)
    
    <tr>
        <td>{{$registration->retreatant->full_name}}</td>
        <td>{{$registration->notes}}</td>
        <td align='center'>{{ $registration->room_name}}</td>
        <td>{{$registration->retreatant->note_room_preference_text}}</td>
       
    </tr>    
    @endforeach
        
</table>
@endIf
<br />
<hr />
<strong>{{$registrations->count()}} Registered Retreatant(s) as of {{date('l, F j, Y')}}</strong>
<hr />


        <span class="logo">
            {!! Html::image('img/mrhlogoblack.png','Home',array('title'=>'Home','class'=>'logo','align'=>'right')) !!}
       
        </span>    
    <span class='pagefooter'>
                600 N Shady Shores Drive<br />
                Lake Dallas, TX 75065<br />
                (940) 321-6020<br /> 
            <a href='http://montserratretreat.org/' target='_blank'>montserratretreat.org</a>
        
    </span>
</div>
@stop