@extends('layouts.app')

    @section('header')
        <title>Delete Report</title>
    @endsection

    @section('content')
    <h1></h1>
    <div class="card text-center">
        <div class="card-header">
            Delete Report
        </div>
        <div class="card-body">

            <h5 class="card-title">Are you sure?</h5>

            {!! Form::open(['action' => ['PostsController@destroy', $id], 'method' => 'POST']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
            <h1></h1>
            <a href="/allreports" class="btn btn-primary">Cancel</a>
        </div>
    </div>
    @endsection
