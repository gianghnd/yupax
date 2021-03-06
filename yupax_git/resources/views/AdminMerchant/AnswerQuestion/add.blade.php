@extends('AdminMerchant.Layouts.default')
@section('slidebar')
@include('AdminMerchant.Layouts.slidebar',[
    'nav'=>'9',
    'sub'=>'1'
])
@stop
@section('content')
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Khảo sát
                <small><!-- ** --></small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE TOOLBAR -->
        <!-- ** -->
        <!-- END PAGE TOOLBAR -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{Asset('/'.env('PREFIX_ADMIN_MERCHANT'))}}">Tổng quan</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{Asset('/'.env('PREFIX_ADMIN_MERCHANT').'/answer-question/list')}}">Danh sách</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Thêm mới</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
             <!-- BEGIN PORTLET-->
             <div class="portlet light bordered" id="blockui_sample_1_portlet_body">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Thêm mới</span>
                        <span class="caption-helper"></span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- ** -->
                    <div class="mt-element-step">
                        <div class="row step-thin">
                            <div class="col-md-4 bg-grey mt-step-col active">
                                <div class="mt-step-number bg-white font-grey">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Bước 1</div>
                                <div class="mt-step-content font-grey-cascade">Nhập dữ liệu</div>
                            </div>
                            <div class="col-md-4 bg-grey mt-step-col ">
                                <div class="mt-step-number bg-white font-grey">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Bước 2</div>
                                <div class="mt-step-content font-grey-cascade">Xác nhận</div>
                            </div>
                            <div class="col-md-4 bg-grey mt-step-col ">
                                <div class="mt-step-number bg-white font-grey">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Bước 3</div>
                                <div class="mt-step-content font-grey-cascade">Hoàn thành</div>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN FORM-->
                    <form action="{{Asset('/'.env('PREFIX_ADMIN_MERCHANT').'/answer-question/add-confirm')}}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                        <div class="form-body">
                            <h3>Câu hỏi</h3>
                            <div class="form-group">
                                <label class="control-label col-md-3">Câu hỏi</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Câu hỏi" name="answer" value="{{$addForm->getAnswer()}}">
                                    <!-- /input-group -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Kiểu</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="type" id="">
                                        <option value="" >Mời chọn</option>
                                        <option value="RATE" @if($addForm->getType()=='RATE')selected @endif >Khảo sát</option>
                                    </select>
                                    <!-- /input-group -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Trạng thái</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="status" id="">
                                        <option value="ACTIVE" @if($addForm->getStatus()=='ACTIVE')selected @endif >Hoạt động</option>
                                        <option value="INACTIVE" @if($addForm->getStatus()=='INACTIVE')selected @endif >Không hoạt động</option>
                                    </select>
                                    <!-- /input-group -->
                                </div>
                            </div>
                            <h3>Câu trả lời</h3>
                            <div class="answers">
                                @if(count($addForm->getListQuestion())>0)
                                    @foreach($addForm->getListQuestion() as $key=>$obj)
                                <div class="form-group answer">
                                    <label class="control-label col-md-3">
                                        <a href="javascript:;" class="btn btn-xs red bt-delete-answer" onclick="removeQuestion(this);">
                                            <i class="fa fa-close"></i>
                                        </a></label>
                                    <div class="col-md-6">
                                        <input type="text" name="question[]" class="form-control" placeholder="Câu trả lời" value="{{$obj}}">
                                        <input type="hidden" name="result[]" class="form-control result" value="{{$addForm->getListResult()[$key]}}">
                                    </div>
                                    <label class="control-label col-md-2"> 
                                        <input type="checkbox" value="1" name="res" @if($addForm->getListResult()[$key]==1) checked @endif onclick="checkResult(this);" />
                                        <span></span>
                                    </label>

                                </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    <a href="javascript:;" class="btn btn-xs blue" onclick="addQuestion(this);">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a></label>
                                <div class="col-md-6">
                                    &nbsp;
                                </div>
                            </div>
                            
                            <div class="form-group last">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-3">
                                    <button type="submit" class="btn green btn-xs">
                                        <i class="fa fa-check"></i> Xác nhận</button>
                                    <button type="button" class="btn default btn-xs" onclick="history.go(-1);">Quay lại</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->

    <!-- END PAGE BASE CONTENT -->
</div>
<!-- END CONTENT BODY -->

@stop
@section('css')
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" />
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{Asset('public/AdminMerchant/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('javascript')
<script src="{{Asset('public/AdminMerchant/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/AdminMerchant/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>

<script src="{{Asset('public/AdminMerchant/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/AdminMerchant/assets/global/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
<script src="{{Asset('public/AdminMerchant/assets/pages/scripts/form_custom.js')}}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    
});
function addQuestion(e){
    
    $.ajax({
        type: "GET",
        url: "{{Asset('/merchant/answer-question/answer-view')}}",
        //data: "address="+$val,
        cache: false,
        beforeSend: function (xhr) {
            App.blockUI({
                target: '#blockui_sample_1_portlet_body'
            });
        },
        success: function(response)
        {
            //alert(response);
            $(".answers").append(response);
            App.unblockUI('#blockui_sample_1_portlet_body');
        }
    });
}

function removeQuestion(e){
    App.blockUI({
        target: '#blockui_sample_1_portlet_body'
    });
    $(e).parent().parent().remove();
    App.unblockUI('#blockui_sample_1_portlet_body');
}

function checkResult(e){
    $val = $(e).parent().parent().find(".result").val();
    if($val==0){
        $(e).parent().parent().find(".result").val(1);
    }else{
        $(e).parent().parent().find(".result").val(0);
    }
}
</script>
@stop