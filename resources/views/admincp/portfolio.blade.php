<!-- Design by DESIFORMAL -->
@extends('admincp.layouts.app')

@section('content')
    <header class="page-header">
        <h2>Portfolio</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('portfolio') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>ตารางข้อมูล</span></li>
                <li><span>Portfolio</span></li>
            </ol>

            <div class="sidebar-right-toggle"></div>
        </div>
    </header>


    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">ตารางข้อมูลผลงาน</h2>
        </header>
        <div class="panel-body">
            <!-- Trigger the modal with a button -->
            <div class="control-panel">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#AddPortfolio"><i class="fa fa-plus"></i> เพิ่มผลงาน</a>
                        <a href="#" id="refresh_button" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                </div>
            </div>

            <table id="datatable-portfolio" class="table table-striped table-bordered table-hover" style="margin-top: 1em;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ชื่อผลงาน</th>
                        <th>ลูกค้า</th>
                        <th>ภาพเล็ก</th>
                        <th>ภาพใหญ่</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>

    <!-- Adding Portfolio Modal -->
    <div id="AddPortfolio" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">เพิ่มผลงาน</h4>
                </div>
                <form id="add_portfolio" enctype="multipart/form-data" method="POST" action="{{ route('portfolio.add') }}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>ชื่อผลงาน</label>
                            <input type="text" name="name" class="form-control" placeholder="กรอกชื่อผลงาน" required>
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label>ลูกค้า</label>
                            <input type="text" name="client" class="form-control" placeholder="กรอกชื่อลูกค้า" required>
                        </div>
                        @if ($errors->has('client'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('client') }}</strong>
                                </span>
                        @endif
                        <div class="form-group">
                            <label>ลิงค์</label>
                            <input type="text" name="link" class="form-control" placeholder="กรอกลิงค์เว็บไซต์" required>
                        </div>
                        @if ($errors->has('link'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('link') }}</strong>
                                </span>
                        @endif
                        <div class="form-group">
                            <label>ภาพเล็ก</label>
                            <input type="file" name="smallpic" required>
                        </div>
                        @if ($errors->has('smallpic'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('smallpic') }}</strong>
                                </span>
                        @endif
                        <div class="form-group">
                            <label>ภาพใหญ่</label>
                            <input type="file" name="fullpic" required>
                        </div>
                        @if ($errors->has('fullpic'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fullpic') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ปิด</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Portfolio Modal -->
    <div id="EditPortfolio" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">แก้ไขผลงาน</h4>
                </div>
                <form id="edit_portfolio" enctype="multipart/form-data" method="POST">
                    {{ method_field('PUT') }}
                    @csrf
                    <input type="hidden" name="id" class="form-control">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>ชื่อผลงาน</label>
                            <input type="text" name="name" class="form-control" placeholder="กรอกชื่อผลงาน" required>
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label>ลูกค้า</label>
                            <input type="text" name="client" class="form-control" placeholder="กรอกชื่อลูกค้า" required>
                        </div>
                        @if ($errors->has('client'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('client') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label>ลิงค์</label>
                            <input type="text" name="link" class="form-control" placeholder="กรอกลิงค์เว็บไซต์" required>
                        </div>
                        @if ($errors->has('link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('link') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label>ภาพเล็ก</label><br>
                            <img name="show-smallpic" width="50px">
                            <input type="file" name="smallpic">
                        </div>
                        @if ($errors->has('smallpic'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('smallpic') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label>ภาพใหญ่</label><br>
                            <img name="show-smallpic" width="50px">
                            <input type="file" name="fullpic">
                        </div>
                        @if ($errors->has('fullpic'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fullpic') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> แก้ไขข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ปิด</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var datatableInit = $('#datatable-portfolio').DataTable({
                "processing": true,
                "ajax": '{{ route('portfolio.showTable') }}',
                "columns": [
                    {
                        "render": function ( data, type, full, meta ) {
                            return full.id;
                        }
                    },
                    {
                        "render": function ( data, type, full, meta ) {
                            return full.name;
                        }
                    },
                    {
                        "render": function ( data, type, full, meta ) {
                            return full.client;
                        }
                    },
                    {
                        "render": function ( data, type, full, meta ) {
                            return "<span id=\"image\" data-toggle=\"tooltip\" title=\"<img src='{{ url('/') }}/img/portfolio/" + full.smallpic + "' width='100px' />\" >"+ full.smallpic +"</span>";
                        }
                    },
                    {
                        "render": function ( data, type, full, meta ) {
                            return "<span id=\"image\" data-toggle=\"tooltip\" title=\"<img src='{{ url('/') }}/img/portfolio/" + full.fullpic + "' width='100px' />\" >"+ full.smallpic +"</span>";
                        }
                    },
                    {
                        "orderable": false,
                        "render": function ( data, type, full, meta ) {
                            return "<a id=\"editPortfolioButton\" href=\"{{ url("/") }}/admincp/portfolio/getData/"+ full.id +"\"><i class=\"fa fa-edit\"></i> แก้ไข</a>";
                        }
                    },
                    {
                        "orderable": false,
                        "render": function ( data, type, full, meta ) {
                            return "<a id='destroyPortfolioButton' href='#' data-id='"+ full.id +"'><i class=\"fa fa-close\"></i> ลบ</a>";
                        }
                    }
                ]
            });

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
