@extends('template')
@section('content')

<div class="row bg-cover">
    <div class="col-lg-12">
        <h1>Create asset type</h1>
    </div>
    <div class="col-lg-12">
        {!! Form::open(['url'=>'admin/asset_type', 'method'=>'post']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', NULL , ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-3 col-md-4">
                        {!! Form::label('label', 'Label')  !!}
                        {!! Form::text('label', NULL , ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', NULL, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        {!! Form::label('parent_asset_type_id', 'Parent asset type')  !!}
                        {!! Form::select('parent_asset_type_id', $asset_types, NULL, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {!! Form::label('is_active', 'Active:', ['class' => 'col-md-1'])  !!}
                        {!! Form::checkbox('is_active', 1, true,['class' => 'col-md-1']) !!}
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12">
                    {!! Form::submit('Add asset type', ['class'=>'btn btn-outline-dark']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
