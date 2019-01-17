@extends('layouts.app')

    @section('header')
     <title>Edit Report</title>
    @endsection

    @section('content')
        <h1>Edit Report</h1>
        <div class="container">
            {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('BUD', 'BUD')}}
                {{Form::select('bud', array('DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), $post->bud, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::label('nama_CC', 'Nama CC')}}
                {{Form::text('nama_CC', $post->nama_CC, ['class' => 'form-control', 'placeholder' => 'Nama CC', 'required'])}}
            </div>
            <div class="form-group">
                {{Form::label('nama_proj', 'Nama Project')}}
                {{Form::text('nama_proj', $post->nama_proj, ['class' => 'form-control', 'placeholder' => 'Nama Project', 'required'])}}
            </div>

            <div class="form-group">
                {{Form::label('nilai_proj', 'Nilai Project (Rp. M)')}}
                {{Form::number('nilai_proj', $post->nilai_proj, ['class' => 'form-control', 'required', 'min' => 0, 'step' => 'any'])}}
            </div>

            <div class="form-group">
                {{Form::label('revenue', 'Nilai Revenue (Rp. M)')}}
                {{Form::number('revenue', $post->revenue, ['class' => 'form-control', 'required', 'min' => 0, 'step' => 'any'])}}
            </div>

            <div class="form-group">
                {{Form::label('status', 'Status')}}
                {{Form::select('status', array('Submission' => 'Submission', 'Prospect' => 'Prospect', 'Win' => 'Win'), $post->status, array('class' => 'form-control'))}}
            </div>

            <div class="form-group">
                {{Form::label('progress', 'Progress')}}
                {{Form::textarea('progress', $post->progress, ['class' => 'form-control', 'placeholder' => 'Progress'])}}

            </div>

            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Save', ['class' => 'btn btn-primary btn-lg btn-block'])}}
            {!! Form::close() !!}
            {{--@if(count($errors) > 0)--}}
                {{--@foreach($errors->all as $error)--}}
                    {{--<div class="alert alert-danger">--}}
                        {{--{{$error}}--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--@endif--}}
            <h1></h1>
            <h1></h1>

        </div>
    @endsection