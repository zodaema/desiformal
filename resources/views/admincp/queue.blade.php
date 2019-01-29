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


    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">จัดการคิวงาน</h2>
        </header>
        <div class="panel-body">
            <div class="col-lg-3">
                <form action="queue.php" method="get" class="form-inline">
                  <div class="form-group">
                    <label>จำนวนเดือน : </label>
                    <div class="input-group">
                      <input name="fetch" type="number" min="1" max="20" class="form-control" value="6">
                    </div>
                    <button type="submit" class="btn">แสดง</button>
                  </div>
                </form>
            </div>
            <div id="showQueue" class="col-lg-9">
                @for ($i=0; $i < 6; $i++)
                    @php
                        $month = date('m',strtotime("+$i months"));
                        $year = date('Y',strtotime("+$i months"));
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
                        $('div#showQueue').load('# div#showQueue');
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
                        $('div#showQueue').load('# div#showQueue');
                        console.log(result.message);
                    }
                });
            });

        });
    </script>
@endsection
