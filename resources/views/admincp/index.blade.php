<!-- Design by DESIFORMAL -->
@extends('admincp.layouts.app')

@section('content')

    <div id="wrapper">

        <!-- Navigation -->
        @extends('admincp.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Portfolio</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ตารางข้อมูลผลงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddPortfolio">เพิ่มผลงาน</button>

                            <div class="dataTable_wrapper">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
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
                            <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
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
                            "render": function ( data, type, full, meta ) {
                                return "<a id=\"editPortfolioButton\" href=\"portfolio/getData/"+ full.id +"\">แก้ไข</a>";
                            }
                        },
                        {
                            "render": function ( data, type, full, meta ) {
                                return "<a href='portfolio/edit/"+ full.id +"'>ลบ</a>";
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


                $(document).on('submit','#edit_portfolio', function(e){
                    e.preventDefault();
                    var data = $(this).serialize();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ url("/") }}/admincp/portfolio/edit/'+ $('#EditPortfolio input[name=id]').val(),
                        method: 'put',
                        data: data,
                        dataType: 'json',
                        success: function(result){
                            $('#EditPortfolio').modal('hide');
                            datatableInit.ajax.reload(null,false);
                            console.log(result.message);
                        }
                    });
                });
            });
        </script>
@endsection
