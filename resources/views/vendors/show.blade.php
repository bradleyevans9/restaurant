@extends('template')
@section('content')

<div class="row bg-cover">
    <div class="col-lg-12 text-center">
        {!!$vendor->avatar_large_link!!}
        <h1>
            @can('update-contact')
                <a href="{{url('vendor/'.$vendor->id.'/edit')}}">
                    {{ $vendor->organization_name }}
                </a>
            @else
                {{ $vendor->organization_name }}
            @endCan
        </h1>
    </div>
    <div class="col-lg-12 text-center">
        {!! Html::link('#notes','Notes',array('class' => 'btn btn-outline-dark')) !!}
        {!! Html::link('#relationships','Relationships',array('class' => 'btn btn-outline-dark')) !!}
        {!! Html::link('#registrations','Registrations',array('class' => 'btn btn-outline-dark')) !!}
        {!! Html::link('#touchpoints','Touchpoints',array('class' => 'btn btn-outline-dark')) !!}
        {!! Html::link('#attachments','Attachments',array('class' => 'btn btn-outline-dark')) !!}
        {!! Html::link('#donations','Donations',array('class' => 'btn btn-outline-dark')) !!}
    </div>
    <div class="col-lg-12 text-center mt-3">
        <span><a href={{ action([\App\Http\Controllers\VendorController::class, 'index']) }}>{!! Html::image('images/vendor.png', 'Vendor Index',array('title'=>"Vendor Index",'class' => 'btn btn-outline-dark')) !!}</a></span>
        @can('create-touchpoint')
            <span><a href={{ action([\App\Http\Controllers\TouchpointController::class, 'add'],$vendor->id) }} class="btn btn-outline-dark">Add Touchpoint</a></span>
        @endCan
        <span class="btn btn-outline-dark">
            <a href={{ URL('person/'.$vendor->id.'/envelope?size=10&logo=0') }}><img src={{URL::asset('images/envelope.png')}} title="Print envelope" alt="Print envelope"></a>
        </span>
        <span class="btn btn-outline-dark">
            <a href={{ URL('person/'.$vendor->id.'/envelope?size=9x6&logo=1') }}><img src={{URL::asset('images/envelope9x6.png')}} title="Print 9x6 envelope" alt="Print 9x6 envelope"></a>
        </span>
        </div>
    <div class="col-lg-12 mt-3">
        <div class="row">
            <div class="col-lg-12 col-lg-6">
                <h2>Addresses</h2>
                @foreach($vendor->addresses as $address)
                    @if (!empty($address->street_address))
                        <strong>{{$address->location->display_name}}:</strong>
                        <address>
                            {!!$address->google_map!!}
                            <br>
                            @if ($address->country_id == config('polanco.country_id_usa'))
                            @else {{$address->country_id}}
                            @endif
                        </address>
                    @endif
                @endforeach
            </div>
            <div class="col-lg-12 col-lg-6">
                <h2>Phone Numbers</h2>
                @foreach($vendor->phones as $phone)
                    @if(!empty($phone->phone))
                        <strong>{{$phone->location->display_name}} - {{$phone->phone_type}}: </strong>{{$phone->phone}} {{$phone->phone_ext}}<br />
                    @endif
                @endforeach
            </div>
            <div class="col-lg-12 col-lg-6">
                <h2>Electronic Communications</h2>
                @foreach($vendor->emails as $email)
                    @if(!empty($email->email))
                        <strong>{{$email->location->display_name}} - Email: </strong><a href="mailto:{{$email->email}}">{{$email->email}}</a><br />
                    @endif
                @endforeach
                @foreach($vendor->websites as $website)
                    @if(!empty($website->url))
                        <strong>{{$website->website_type}} - URL: </strong><a href="{{$website->url}}" target="_blank">{{$website->url}}</a><br />
                    @endif
                @endforeach
            </div>
            <div class="col-lg-12 col-lg-6" id="notes">
                <h2>Notes</h2>
                @foreach($vendor->notes as $note)
                    @if(!empty($note->note))
                        <strong>{{$note->subject}}: </strong>{{$note->note}} (modified: {{$note->modified_date}})<br />
                    @endif
                @endforeach
            </div>
            <div class="col-lg-12 col-lg-6" id="relationships">
                <h2>Relationships for {{ $vendor->display_name }} ({{ $vendor->a_relationships->count() + $vendor->b_relationships->count() }})</h2>
                {!! Form::open(['method' => 'POST', 'route' => ['relationship_type.addme']]) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::label('relationship_type', 'Add Relationship: ')  !!}
                        </div>
                        <div class="col-lg-6">
                            {!! Form::select('relationship_type', $relationship_types, NULL, ['class' => 'form-control']) !!}
                            {!! Form::hidden('contact_id',$vendor->id)!!}
                        </div>
                        <div class="col-lg-6">
                            {!! Form::submit('Create relationship', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                @foreach($vendor->a_relationships as $a_relationship)
                    <li>
                        @can('delete-relationship')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['relationship.destroy', $a_relationship->id],'onsubmit'=>'return ConfirmDelete()']) !!}
                                {!!$vendor->contact_link!!} {{ $a_relationship->relationship_type->label_a_b }} {!! $a_relationship->contact_b->contact_link !!}
                                {!! Form::image('images/delete.png','btnDelete',['title'=>'Delete Relationship '.$a_relationship->id, 'style'=>'padding-left: 50px;']) !!}
                            {!! Form::close() !!}
                        @else
                            {!!$vendor->contact_link!!} {{ $a_relationship->relationship_type->label_a_b }} {!! $a_relationship->contact_b->contact_link !!}
                        @endCan
                    </li>
                @endforeach

                @foreach($vendor->b_relationships as $b_relationship)
                    <li>
                        @can('delete-relationship')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['relationship.destroy', $b_relationship->id],'onsubmit'=>'return ConfirmDelete()']) !!}
                            {!!$vendor->contact_link!!} {{ $b_relationship->relationship_type->label_b_a }} {!! $b_relationship->contact_a->contact_link!!}
                            {!! Form::image('images/delete.png','btnDelete',['title'=>'Delete Relationship '.$b_relationship->id, 'style'=>'padding-left: 50px;']) !!}
                            {!! Form::close() !!}
                        @else
                            {!!$vendor->contact_link!!} {{ $b_relationship->relationship_type->label_b_a }} {!! $b_relationship->contact_a->contact_link!!}
                        @endCan
                    </li>
                @endforeach
            </div>
            <div class="col-lg-12" id="registrations">
                <div class="col-lg-12">
                    <h2>Retreat Participation for {{ $vendor->display_name }} ({{ $registrations->total() }})</h2>
                    {{ $registrations->links() }}
                    <ul>
                        @foreach($registrations as $registration)
                            <li>{!!$registration->event_link!!} ({{date('F j, Y', strtotime($registration->event->start_date))}} - {{date('F j, Y', strtotime($registration->event->end_date))}}) </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @can('show-touchpoint')
            <div class="col-lg-12" id="touchpoints">
                <h2>Touchpoints for {{ $vendor->display_name }} ({{ $touchpoints->total() }})</h2>
                @can('create-touchpoint')
                    <span class="btn btn-outline-dark">
                        <a href={{ action([\App\Http\Controllers\TouchpointController::class, 'add'],$vendor->id) }}>Add Touchpoint</a>
                    </span>
                @endCan
                @if ($touchpoints->isEmpty())
                    <div class="text-center">
                        <p>It is a brand new world, there are no touchpoints for this person!</p>
                    </div>
                @else
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Contacted by</th>
                                <th>Type of contact</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($touchpoints->sortByDesc('touched_at') as $touchpoint)
                            <tr>
                                <td><a href="../touchpoint/{{ $touchpoint->id}}">{{ $touchpoint->touched_at }}</a></td>
                                <td>{!! $touchpoint->staff->contact_link_full_name ?? 'Unknown staff member' !!}</a></td>
                                <td>{{ $touchpoint->type }}</td>
                                <td>{{ $touchpoint->notes }}</td>
                            </tr>
                            @endforeach
                            {{ $touchpoints->links() }}
                        </tbody>
                    </table>
                @endif
            </div>
            @endcan
            @can('show-attachment')
            <div class="col-lg-12" id="attachments">
                <h2>Attachments for {{ $vendor->display_name }}</h2>
                @if ($files->isEmpty())
                    <div class="text-center">
                        <p>This user currently has no attachments</p>
                    </div>
                @else
                    <table class="table table-striped table-bordered table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Uploaded date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files->sortByDesc('upload_date') as $file)
                            <tr>
                                <td><a href="{{url('contact/'.$vendor->id.'/attachment/'.$file->uri)}}">{{ $file->uri }}</a></td>
                                <td>{{ $file->description_text }}</td>
                                <td>{{ $file->upload_date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @endCan
            @can('show-donation')
            <div class="col-lg-12" id="donations">
                <h2>Donations for {{ $vendor->display_name }} ({{$donations->total() }} donations totaling:  ${{ number_format($donations->sum('donation_amount'),2)}})</h2>
                @can('create-donation')
                    <a href={{ url('donation/add/'.$vendor->id) }} class="btn btn-outline-dark">Add donation</a>
                @endCan
                @if ($donations->isEmpty())
                    <div class="text-center">
                        <p>No donations for this vendor!</p>
                    </div>
                @else
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Paid / Pledged</th>
                                <th>Terms</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($donations->sortByDesc('donation_date') as $donation)
                            <tr>
                                <td><a href="../donation/{{$donation->donation_id}}"> {{ $donation->donation_date_formatted }} </a></td>
                                <td> {{ $donation->donation_description.': #'.optional($donation->retreat)->idnumber }}</td>

                                @if ($donation->donation_amount - $donation->payments->sum('payment_amount') > 0.001)
                                  <td class="alert alert-warning alert-important" style="padding:0px;">
                                @endIf
                                @if ($donation->donation_amount - $donation->payments->sum('payment_amount') < -0.001)
                                  <td class="alert alert-danger alert-important" style="padding:0px;">
                                @endIf
                                @if (abs($donation->donation_amount - $donation->payments->sum('payment_amount')) < 0.001)
                                  <td>
                                @endIf

                                ${{ number_format($donation->payments->sum('payment_amount'),2)}}
                                    / ${{number_format($donation->donation_amount, 2) }}
                                    [{{$donation->percent_paid}}%]
                                </td>

                                <td> {{ $donation->terms }}</td>
                                <td> {{ $donation->Notes }}</td>
                            </tr>
                        @endforeach
                        {!! $donations->links()!!}
                        </tbody>
                    </table>
                @endif
            </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-6 text-right">
                @can('update-contact')
                    <a href="{{ action([\App\Http\Controllers\VendorController::class, 'edit'], $vendor->id) }}" class="btn btn-info">{!! Html::image('images/edit.png', 'Edit',array('title'=>"Edit")) !!}</a>
                @endCan
            </div>
            <div class="col-lg-6 text-left">
                @can('delete-contact')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['vendor.destroy', $vendor->id],'onsubmit'=>'return ConfirmDelete()']) !!}
                    {!! Form::image('images/delete.png','btnDelete',['class' => 'btn btn-danger','title'=>'Delete']) !!}
                    {!! Form::close() !!}
                @endCan
            </div>
        </div>
    </div>
</div>
@stop
