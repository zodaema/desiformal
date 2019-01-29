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
                <form action="queue.php" method="get" class="form-inline" style="margin-bottom:2em;">
                  <div class="form-group">
                    <label>จำนวนเดือน : </label>
                    <div class="input-group">
                      <input name="fetch" type="number" min="1" max="20" class="form-control" value="6">
                    </div>
                    <button type="submit" class="btn">แสดง</button>
                  </div>
                </form>
            </div>
            <div class="col-lg-9">
                @php
                    use App\Http\Controllers\Admincp\QueueController;
                @endphp

                @for ($i=0; $i < 6; $i++)
                    @php
                        $month = date('m',strtotime("$i month"));
                        $year = date('Y',strtotime("$i month"));
                        $queue = QueueController::requestQueue($month,$year);
                        $percent = $queue['queue']*50;
                    @endphp
                    {{ $month_name[$month] .' '. $year }}
                    <a href="#"><i class="fa fa-plus-square"></i></a>
                    @if($queue['queue'] != 0)
                    <a href="#"><i class="fa fa-minus-square"></i></a>
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

            $(document).tooltip({
                selector: 'span[data-toggle="tooltip"]',
                animated: 'fade',
                placement: 'bottom',
                html: true
            });

            $(document).on('click','#editPortfolioButton', function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(this).attr("href"),
                    method: 'get',
                    dataType: 'json',
                    success: function(result){
                        $('#EditPortfolio').modal('show');
                        $('#EditPortfolio input[name=id]').val(result.id);
                        $('#EditPortfolio input[name=name]').val(result.name);
                        $('#EditPortfolio input[name=client]').val(result.client);
                        $('#EditPortfolio input[name=link]').val(result.link);
                        $('#EditPortfolio img[name=show-smallpic]').attr('src','{{ url("/") }}/img/portfolio/' + result.smallpic);
                        $('#EditPortfolio img[name=show-fullpic]').attr('src','{{ url("/") }}/img/portfolio/' + result.fullpic);
                        console.log(result);
                    }
                });
            });


            $(document).on('submit','#add_portfolio', function(e){
                e.preventDefault();
                var data = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ url("/") }}/admincp/portfolio/add/',
                    method: 'post',
                    cache:false,
                    contentType: false,
                    processData: false,
                    data: data,
                    dataType: 'json',
                    success: function(result){
                        $('#AddPortfolio').modal('hide');
                        datatableInit.ajax.reload(null,false);
                        console.log(result.message);
                    }
                });
            });

            $(document).on('submit','#edit_portfolio', function(e){
                e.preventDefault();
                var data = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ url("/") }}/admincp/portfolio/edit/'+ $('#EditPortfolio input[name=id]').val(),
                    method: 'put',
                    cache:false,
                    contentType: false,
                    processData: false,
                    data: data,
                    dataType: 'json',
                    success: function(result){
                        $('#EditPortfolio').modal('hide');
                        datatableInit.ajax.reload(null,false);
                        console.log(result.message);
                    }
                });
            });

            $(document).on('click','#destroyPortfolioButton', function(e){
                e.preventDefault();
                var data = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ url("/") }}/admincp/portfolio/destroy/'+ data,
                    method: 'get',
                    success: function(result){
                        datatableInit.ajax.reload(null,false);
                        console.log(result.message);
                    }
                });
            });

            $(document).on('click','#refresh_button', function(e){
                e.preventDefault();
                datatableInit.ajax.reload(null,false);
            });
        });
    </script>
@endsection
