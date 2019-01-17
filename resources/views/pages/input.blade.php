@extends('layouts.app')

    @section('header')
     <title>Input Report</title>
    @endsection

    @section('content')
        <h1>Input Report</h1>
        <div class="container">
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
            @if($user_bud == 'DBS')
                <div class="form-group">
                    {{Form::label('BUD', 'BUD')}}
                    {{Form::select('bud', array('DBS' => 'DBS'), 'DBS', array('class' => 'form-control'))}}
                </div>
            @elseif($user_bud == 'DGS')
                <div class="form-group">
                    {{Form::label('BUD', 'BUD')}}
                    {{Form::select('bud', array('DGS' => 'DGS'), 'DGS', array('class' => 'form-control'))}}
                </div>
            @elseif($user_bud == 'DES')
                <div class="form-group">
                    {{Form::label('BUD', 'BUD')}}
                    {{Form::select('bud', array('DES' => 'DES'), 'DES', array('class' => 'form-control'))}}
                </div>
            @else
                <div class="form-group">
                    {{Form::label('BUD', 'BUD')}}
                    {{Form::select('bud', array('DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), 'DBS', array('class' => 'form-control'))}}
                </div>
            @endif

            <div class="form-group">
                {{Form::label('nama_CC', 'Nama CC')}}
                {{Form::text('nama_CC', '', ['class' => 'form-control', 'required'])}}
            </div>
            <div class="form-group">
                {{Form::label('nama_proj', 'Nama Project')}}
                {{Form::text('nama_proj', '', ['class' => 'form-control', 'required'])}}
            </div>

            <div class="form-group">
                {{Form::label('nilai_proj', 'Nilai Project (Rp. M)')}}
                {{Form::number('nilai_proj', '', ['class' => 'form-control', 'required', 'min' => 0, 'step' => 'any'])}}
            </div>

            <div class="form-group">
                {{Form::label('revenue', 'Nilai Revenue (Rp. M)')}}
                {{Form::number('revenue', '', ['class' => 'form-control', 'required', 'min' => 0, 'step' => 'any'])}}
            </div>

            <div class="form-group">
                {{Form::label('status', 'Status')}}
                {{Form::select('status', array('Submission' => 'Submission', 'Prospect' => 'Prospect', 'Win' => 'Win', 'BillComp' => 'BillComp'), 'Submission', array('class' => 'form-control'))}}
            </div>

            <div class="form-group">
                {{Form::label('progress', 'Progress')}}
                {{Form::textarea('progress', '', ['class' => 'form-control'])}}

            </div>

            {{Form::submit('Save', ['class' => 'btn btn-primary btn-lg btn-block'])}}
            {!! Form::close() !!}
            <h1></h1>
            <h1></h1>

        </div>
    @endsection