@extends('layouts.app')

    @section('header')
        <title>Reports Details</title>
    @endsection

    @section('content')
        <h1></h1>
        @if($message != "")
            <div class="alert alert-success">
                {{$message}}
            </div>
        @endif
        <h2>Reports Detail</h2>
        <div class="row">
            <div class="col-sm-auto">
                <div class="card" style="height: fit-content; width: fit-content;">
                    <div class="card-header">
                        Filter
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => '/allreports', 'method' => 'GET']) !!}
                        <?php try{

                        ?>
                        {{Form::select('bud', array('All' => 'All BUD', 'DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), $_GET['bud'])}}
                        {{Form::select('status', array('All' => 'All Status', 'Submission' => 'Submission', 'Prospect' => 'Prospect', 'Win' => 'Win'), $_GET['status'])}}

                    @if($_GET['week'] == 'this')
                            {{Form::radio('week', 'all', false, ['onchange' => 'submitForm()'])}}
                            {{Form::label('week1', 'All')}}
                            {{Form::radio('week', 'this', true, ['onchange' => 'submitForm()'])}}
                            {{Form::label('week2', 'This week')}}
                        @else
                            {{Form::radio('week', 'all', true)}}
                            {{Form::label('week1', 'All')}}
                            {{Form::radio('week', 'this', false)}}
                            {{Form::label('week2', 'Last 7 days')}}
                        @endif


                    <?php
                        }
                        catch (Exception $e){ ?>
                        {{Form::select('bud', array('All' => 'All BUD', 'DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), 'All')}}
                        {{Form::select('status', array('All' => 'All Status', 'Submission' => 'Submission', 'Prospect' => 'Prospect', 'Win' => 'Win'), 'All')}}
                        {{Form::radio('week', 'all', true)}}
                        {{Form::label('week1', 'All')}}
                        {{Form::radio('week', 'this', false)}}
                        {{Form::label('week2', 'Last 7 days')}}

                        <?php }?>

                        {{Form::submit('Set')}}
                        {!! Form::close() !!}

                            {{--{{Form::select('bud', array('DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), null, ['placeholder' => 'Filter by BUD'])}}--}}
                        {{--{{Form::submit('Apply')}}--}}
                        {{--{!! Form::close() !!}--}}

                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-auto ">
                <div class="card" style="height: fit-content; width: fit-content;">
                    <div class="card-header">
                        Search
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => '/allreports', 'method' => 'GET']) !!}
                        {{Form::text('keyword', '', ['placeholder' => 'Search...'])}}
                        {{Form::submit('Search')}}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <h1></h1>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-active table-bordered">
                        <?php
                        if(count($posts) > 0){ ?>
                            <th>No</th>
                            <th>BUD</th>
                            <th>Nama CC</th>
                            <th>Nama Project</th>
                            <th>Nilai Project</th>
                            <th>Nilai Revenue</th>
                            <th>Status</th>
                            <th>Update Progress</th>
                            <th>Last Modified</th>
                            <th></th>
                            <th></th>

                            <?php

                            $i = 1;

                            foreach($posts as $post){
                                try{
                                    if ($_GET['week'] == 'this'){
                                        date_default_timezone_set('Asia/Jakarta');
                                        $now = new DateTime(date('Y-m-d H:i:s'));
                                        $update = new DateTime($post->updated_at);
                                        $interval = $now->diff($update);
                                        $interval_int = (int)$interval->format('%d');

                                        if ($interval_int <= 7){ ?>

                                <tr class="table-success">
                                    <td><?php echo $i; $i++; ?></td>
                                    <td>{{$post->bud}}</td>
                                    <td>{{$post->nama_CC}}</td>
                                    <td>{{$post->nama_proj}}</td>
                                    <td>{{$post->nilai_proj}}</td>
                                    <td>{{$post->revenue}}</td>
                                    <td>{{$post->status}}</td>
                                    <td>{{$post->progress}}</td>
                                    <td>{{$post->updated_at}}</td>

                                    @if($user_bud == $post->bud)
                                        <td><a href="/delete/?id={{$post->id}}" class="btn btn-danger">Delete</a> </td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a></td>
                                    @endif
                                    {{--<td><a href="/edit/?id={{$post->id}}" class="btn btn-dark">Edit</a> </td>--}}
                                    {{--<td> {!! Form::open(['action' => ['PostsController@edit', $post->id], 'method' => 'GET']) !!}--}}
                                         {{--{{Form::submit('Edit', ['class' => 'btn btn-dark'])}}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--</td>--}}
                                </tr>
                                <?php
                                }
                                        }
                                    else{?>
                            <tr class="table-success">
                                <td><?php echo $i; $i++; ?></td>
                                <td>{{$post->bud}}</td>
                                <td>{{$post->nama_CC}}</td>
                                <td>{{$post->nama_proj}}</td>
                                <td>{{$post->nilai_proj}}</td>
                                <td>{{$post->revenue}}</td>
                                <td>{{$post->status}}</td>
                                <td>{{$post->progress}}</td>
                                <td>{{$post->updated_at}}</td>

                                @if($user_bud == $post->bud)
                                    <td><a href="/delete/?id={{$post->id}}" class="btn btn-danger">Delete</a> </td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a></td>
                                @endif
                            </tr>

                           <?php
                                        }
                                    }

                                        catch (Exception $e){
                                    ?>
                                        {{--foreach ($posts as $post){ ?>--}}
                                    <tr class="table-success">
                                        <td><?php echo $i; $i++; ?></td>
                                        <td>{{$post->bud}}</td>
                                        <td>{{$post->nama_CC}}</td>
                                        <td>{{$post->nama_proj}}</td>
                                        <td>{{$post->nilai_proj}}</td>
                                        <td>{{$post->revenue}}</td>
                                        <td>{{$post->status}}</td>
                                        <td>{{$post->progress}}</td>
                                        <td>{{$post->updated_at}}</td>

                                        @if($user_bud == $post->bud)
                                            <td><a href="/delete/?id={{$post->id}}" class="btn btn-danger">Delete</a> </td>
                                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a></td>
                                        @endif
                                    </tr>

                                <?php
                                        }
                                        }

                            }

                            else{                            ?>

                            <h1></h1>
                            <h1></h1>
                            <h5>Data not found</h5>
                            <?php } ?>

                    </table>
                </div>

            </div>

        </div>

    @endsection
