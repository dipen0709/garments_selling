@extends('app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
<!--    <h3 class="text-primary mb-4">
        <button type="button" class="btn-primary btn add_cloth" style="float: right; margin-right: 10px;">Add Kapad Type</button>
    </h3>-->
   
    <div class="modal fade  " id="add_cloth" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" ><div class="fade "></div>
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="overflow: inherit;">
                 <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Kapad Type</h4>
            </div>
                <div class="modal-body">
                    <form method="post" id="add-ondemand-app-type">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="modal-body input-text-field-line">
                            <div class="form-group">
                                <label class="font-normal">Kapad Type</label>
                                <input type="text" class="form-control p-input" id="cloth_name" name="cloth_name" placeholder="name" value="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer add-btn-app-type" style="text-align: center;"> 
                    <button type="button" class="btn btn-primary btn-lg pull-right insert-cloth">Add</button>               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection