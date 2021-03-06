<!-- Design by DESIFORMAL -->
@extends('admincp.layouts.app')

@section('content')
    <header class="page-header">
        <h2>Queue</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('queue') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>จัดการ</span></li>
                <li><span>Queue</span></li>
            </ol>

            <div class="sidebar-right-toggle"></div>
        </div>
    </header>

    @php
        session()->regenerate();
        if(!Session::has('fetch')){
            $fetch = '6';
        }
        else{
            $fetch = Session::get('fetch');
        }
    @endphp

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">จัดการคิวงาน</h2>
        </header>
        <div class="panel-body">
            <div class="col-lg-3">
                <form id="fetchForm" method="post" class="form-inline">
                  <div class="form-group">
                    <label>จำนวนเดือน : </label>
                    <div class="input-group">
                      <input name="fetch" type="number" min="1" max="20" class="form-control" value="{{$fetch}}">
                    </div>
                    <button type="submit" class="btn">แสดง</button>
                  </div>
                </form>
            </div>
            <div id="showQueue" class="col-lg-9">
                @for ($i=0; $i < $fetch; $i++)
                    @php
                        $month = date('m',strtotime("first day of +$i months"));
                        $year = date('Y',strtotime("first day of +$i months"));
                        $queue = App\Http\Controllers\Admincp\QueueController::requestQueue($month,$year);
                        $percent = $queue['queue']*50;
                    @endphp
                    {{ $month_name[$month] .' '. $year }}
                    <a id="queuePlusButton" href="{{ route('queuePlus', ['month'=>$month, 'year'=>$year]) }}"><i class="fa fa-plus-square"></i></a>
                    @if($queue['queue'] != 0)
                    <a id="queueMinusButton" href="{{ route('queueMinus', ['month'=>$month, 'year'=>$year]) }}"><i class="fa fa-minus-square"></i></a>
                    @endif
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ $percent }}"
                             aria-valuemin="0" aria-valuemax="100" style="width:{{ $percent }}%">
                            <span class="sr-only">{{ $percent }}% Complete</span>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){

            $(document).on('click','#queuePlusButton', function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(this).attr('href'),
                    method: 'get',
                    success: function(result){
                        $.get("#", function(data) {
                            $("div#showQueue").replaceWith($(data).find("div#showQueue"));
                        });
                        new PNotify({
                            title: 'Success!',
                            text: 'เพิ่มคิวงานแล้ว.',
                            type: 'success'
                        });
                        console.log(result.message);
                    }
                });
            });

            $(document).on('click','#queueMinusButton', function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(this).attr('href'),
                    method: 'get',
                    success: function(result){
                        new PNotify({
                            title: 'Success!',
                            text: 'ลบคิวงานแล้ว.',
                            type: 'success'
                        });
                        $.get("#", function(data) {
                            $("div#showQueue").replaceWith($(data).find("div#showQueue"));
                        });
                        console.log(result.message);
                    }
                });
            });

            $(document).on('submit','form#fetchForm', function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'sessionFetch/' + $('input[name=fetch]').val(),
                    method: 'get',
                    success: function(result){
                        $.get("#", function(data) {
                            $("div#showQueue").replaceWith($(data).find("div#showQueue"));
                        });
                        console.log(result.message);
                    }
                });
            });

        });
    </script>
@endsection
