@extends('layouts.app')

    @section('header')
        <title>Dashboard</title>
    @endsection

    @section('content')
        {{--<h6>Dashboard</h6>--}}

        {{--<div class="container">--}}
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>Rekap New GTMA EBIS</h5>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => '/', 'name' => 'myForm', 'method' => 'GET']) !!}
                        <?php try{

                        ?>
                            {{Form::select('bud', array('All' => 'All BUD', 'DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), $_GET['bud'], array('onchange' => 'this.form.submit()'))}}
                            @if($_GET['week'] == 'this')
                                {{Form::radio('week', 'all', false, ['onchange' => 'this.form.submit()'])}}
                                {{Form::label('week1', 'All')}}
                                {{Form::radio('week', 'this', true, ['onchange' => 'this.form.submit()'])}}
                                {{Form::label('week2', 'Last 7 days')}}
                            @else
                                {{Form::radio('week', 'all', true, ['onchange' => 'this.form.submit()'])}}
                                {{Form::label('week1', 'All')}}
                                {{Form::radio('week', 'this', false,['onchange' => 'this.form.submit()'])}}
                                {{Form::label('week2', 'Last 7 days')}}

                            @endif

                        <?php
                        }
                        catch (Exception $e){
                            $_GET['bud'] = 'All';
                            $_GET['week'] = 'all'?>
                        {{Form::select('bud', array('All' => 'All BUD', 'DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), 'All', array('onchange' => 'this.form.submit()'))}}
                        {{Form::radio('week', 'all', true, ['onchange' => 'this.form.submit()'])}}
                        {{Form::label('week1', 'All')}}
                        {{Form::radio('week', 'this', false, ['onchange' => 'this.form.submit()'])}}
                        {{Form::label('week2', 'Last 7 days')}}

                        <?php }?>

                        {{--{{Form::submit('Set')}}--}}
                        {!! Form::close() !!}

                        <script>

                        $("select[name='bud']").change(function(){
                        var auto_refresh = setInterval(
                        function()
                        {
                        submitForm();
                        }, 1000);

                        // function submitForm()
                        // {
                        //     //alert('test');
                        //     document.myForm.submit();
                        // }
                        });

                        function submitForm()
                        {
                        //alert('test');
                        document.myForm.submit();
                        }

                        </script>

                            <h3></h3>
                            <h3></h3>
                            {{--<center>--}}


                                <div class="row">
                                    {{--<div class="col-lg-4"></div>--}}
                                    {{--<div class="container">--}}
                                        <div class="row">
                                            {{--<div class="col-lg-1"></div>--}}

                                            <a href="/allreports?bud={{$_GET['bud']}}&status=Prospect&week={{$_GET['week']}}" class="col-sm-12 col-lg-6">
                                                <div href="" class="card text-white bg-primary mb-3" style="margin-left: 300px;height: fit-content;">
                                                    <div class="card-header">PROSPECT</div>
                                                    <div class="card-body">
                                                        <h6 class="card-title">Project : </h6>
                                                        <span style="font-size: 20px">{{$prospect["proj"]}} M</span>
                                                        <h6 class="card-title">Revenue : </h6>
                                                        <span style="font-size: 20px">{{$prospect["revenue"]}} M</span>
                                                        {{--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/allreports?bud={{$_GET['bud']}}&status=Submission&week={{$_GET['week']}}" class="col-sm-12 col-lg-6">
                                                <div class="card text-white bg-info mb-3" style="margin-right: 300px; height: fit-content">
                                                    <div class="card-header">SUBMISSION</div>
                                                    <div class="card-body">
                                                        <h6 class="card-title">Project : </h6>
                                                        <span style="font-size: 20px">{{$submission["proj"]}} M</span>
                                                        <h6 class="card-title">Revenue : </h6>
                                                        <span style="font-size: 20px">{{$submission["revenue"]}} M</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="w-100"></div>
                                            <a href="/allreports?bud={{$_GET['bud']}}&status=Win&week={{$_GET['week']}}" class="col-sm-12 col-lg-6">
                                                <div class="card text-white bg-success mb-3" style="margin-left: 300px; height: fit-content">
                                                    <div class="card-header">WIN</div>
                                                    <div class="card-body">
                                                        <h6 class="card-title">Project : </h6>
                                                        <span style="font-size: 20px">{{$win["proj"]}} M</span>
                                                        <h6 class="card-title">Revenue : </h6>
                                                        <span style="font-size: 20px">{{$win["revenue"]}} M</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/allreports?bud={{$_GET['bud']}}&status=Billcomp&week={{$_GET['week']}}" class="col-sm-12 col-lg-6">
                                                <div class="card text-white bg-danger mb-3" style="margin-right: 300px; height: fit-content">
                                                    <div class="card-header">BILLCOMP</div>
                                                    <div class="card-body">
                                                        <h6 class="card-title">Project : </h6>
                                                        <span style="font-size: 20px">{{$billcomp["proj"]}} M</span>
                                                        <h6 class="card-title">Revenue : </h6>
                                                        <span style="font-size: 20px">{{$billcomp["revenue"]}} M</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    {{--</div>--}}

                        </div>

                    </div>
                </div>
            </div>

        </div>


        {{--</div>--}}

    @endsection