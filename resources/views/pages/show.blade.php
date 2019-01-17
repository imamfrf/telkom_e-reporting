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
                        {{Form::select('bud', array('All' => 'All BUD', 'DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), $_GET['bud'], array('onchange' => 'this.form.submit()'))}}
                        {{Form::select('status', array('All' => 'All Status', 'Submission' => 'Submission', 'Prospect' => 'Prospect', 'Win' => 'Win'), $_GET['status'], array('onchange' => 'this.form.submit()'))}}

                    @if($_GET['week'] == 'this')
                            {{Form::radio('week', 'all', false, ['onchange' => 'this.form.submit()'])}}
                            {{Form::label('week1', 'All')}}
                            {{Form::radio('week', 'this', true, ['onchange' => 'this.form.submit()'])}}
                            {{Form::label('week2', 'Last 7 days')}}
                        @else
                            {{Form::radio('week', 'all', true, ['onchange' => 'this.form.submit()'])}}
                            {{Form::label('week1', 'All')}}
                            {{Form::radio('week', 'this', false, ['onchange' => 'this.form.submit()'])}}
                            {{Form::label('week2', 'Last 7 days')}}
                        @endif


                    <?php
                        }
                        catch (Exception $e){ ?>
                        {{Form::select('bud', array('All' => 'All BUD', 'DBS' => 'DBS', 'DGS' => 'DGS', 'DES' => 'DES'), 'All', array('onchange' => 'this.form.submit()'))}}
                        {{Form::select('status', array('All' => 'All Status', 'Submission' => 'Submission', 'Prospect' => 'Prospect', 'Win' => 'Win'), 'All', array('onchange' => 'this.form.submit()'))}}
                        {{Form::radio('week', 'all', true, ['onchange' => 'this.form.submit()'])}}
                        {{Form::label('week1', 'All')}}
                        {{Form::radio('week', 'this', false, ['onchange' => 'this.form.submit()'])}}
                        {{Form::label('week2', 'Last 7 days')}}

                        <?php }?>

                        {{--{{Form::submit('Set')}}--}}
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
                    <table class="table table-sm table-active" id="reportTable">
                        <?php
                            $cnt = 0;
                            $wk = '';
                        if(count($posts) > 0){ ?>
                        <thead>
                            <th>No</th>
                            <th>BUD</th>
                            <th>Nama CC</th>
                            <th>Nama Project</th>
                            <th>Nilai Project (M)</th>
                            <th>Nilai Revenue (M)</th>
                            <th>Status</th>
                            <th>Update Progress</th>
                            <th>Last Modified</th>
                            <th></th>
                            <th></th>
                        </thead>
                            <tbody>

                            <?php

                            $i = 1;

                            foreach($posts as $post){
                                try{
                                    if ($_GET['week'] == 'this'){
                                        $wk = 'this';
                                        date_default_timezone_set('Asia/Jakarta');
                                        $now = new DateTime(date('Y-m-d H:i:s'));
                                        $update = new DateTime($post->updated_at);
                                        $interval = $now->diff($update);
                                        $interval_int = (int)$interval->format('%d');

                                        if ($interval_int <= 7){
                                            $cnt++; ?>

                                <tr class="table-success">
                                    <td><?php echo $i; $i++; ?></td>
                                    <td>{{$post->bud}}</td>
                                    <td>{{$post->nama_CC}}</td>
                                    <td>{{$post->nama_proj}}</td>
                                    <td>Rp. {{$post->nilai_proj}}</td>
                                    <td>Rp. {{$post->revenue}}</td>
                                    <td>{{$post->status}}</td>
                                    <td>{{$post->progress}}</td>
                                    <td>{{$post->updated_at}}</td>

                                    @if($user_bud == $post->bud || $user_bud == 'All')
                                        <td><a href="/posts/{{$post->id}}/edit"><img src="{{asset('open-iconic/svg/pencil.svg')}}" style="width: 12px; height: 12px;"></a></td>
                                        <td><a href="/delete/?id={{$post->id}}" ><img src="{{asset('open-iconic/svg/trash.svg')}}" style="width: 12px; height: 12px;"></a></td>
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
                                    else{ $wk = '';?>
                            <tr class="table-success">
                                <td><?php echo $i; $i++; $cnt = 0;?></td>
                                <td>{{$post->bud}}</td>
                                <td>{{$post->nama_CC}}</td>
                                <td>{{$post->nama_proj}}</td>
                                <td>Rp. {{$post->nilai_proj}}</td>
                                <td>Rp. {{$post->revenue}}</td>
                                <td>{{$post->status}}</td>
                                <td>{{$post->progress}}</td>
                                <td>{{$post->updated_at}}</td>

                                @if($user_bud == $post->bud || $user_bud == 'All')
                                    <td><a href="/posts/{{$post->id}}/edit"><img src="{{asset('open-iconic/svg/pencil.svg')}}" style="width: 12px; height: 12px;"></a></td>
                                    <td><a href="/delete/?id={{$post->id}}" ><img src="{{asset('open-iconic/svg/trash.svg')}}" style="width: 12px; height: 12px;"></a></td>
                                @endif
                            </tr>

                           <?php
                                        }
                                    }

                                        catch (Exception $e){
                                    ?>
                                        {{--foreach ($posts as $post){ ?>--}}
                                    <tr class="table-success">
                                        <td><?php echo $i; $i++; $cnt = 0;?></td>
                                        <td>{{$post->bud}}</td>
                                        <td>{{$post->nama_CC}}</td>
                                        <td>{{$post->nama_proj}}</td>
                                        <td>Rp. {{$post->nilai_proj}}</td>
                                        <td>Rp. {{$post->revenue}}</td>
                                        <td>{{$post->status}}</td>
                                        <td>{{$post->progress}}</td>
                                        <td>{{$post->updated_at}}</td>

                                        @if($user_bud == $post->bud || $user_bud == 'All')
                                            <td><a href="/posts/{{$post->id}}/edit"><img src="{{asset('open-iconic/svg/pencil.svg')}}" style="width: 12px; height: 12px;"></a></td>
                                            <td><a href="/delete/?id={{$post->id}}" ><img src="{{asset('open-iconic/svg/trash.svg')}}" style="width: 12px; height: 12px;"></a></td>
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

                            </tbody>
                    </table>
                     {{--export table to excel code from : https://stackoverflow.com/questions/22317951/export-html-table-data-to-excel-using-javascript-jquery-is-not-working-properl--}}
                    <iframe id="txtArea1" style="display:none"></iframe>
                    @if(count($posts) > 0 )
                        @if($wk == 'this' && $cnt == 0)

                            @else
                            <button id="btnExport" class="btn btn-primary" onclick="fnExcelReport();"> Download as Excel</button>

                        @endif
                    @endif
                    <script>
                        function fnExcelReport()
                        {
                            var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
                            var textRange; var j=0;
                            tab = document.getElementById('reportTable'); // id of table

                            for(j = 0 ; j < tab.rows.length ; j++)
                            {
                                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                                //tab_text=tab_text+"</tr>";
                            }

                            tab_text=tab_text+"</table>";
                            tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
                            tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                            tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

                            var ua = window.navigator.userAgent;
                            var msie = ua.indexOf("MSIE ");

                            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                            {
                                txtArea1.document.open("txt/html","replace");
                                txtArea1.document.write(tab_text);
                                txtArea1.document.close();
                                txtArea1.focus();
                                sa=txtArea1.document.execCommand("SaveAs",true,"report.xls");
                            }
                            else                 //other browser not tested on IE 11
                                sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

                            return (sa);
                        }
                    </script>
                </div>

            </div>

        </div>

    @endsection
