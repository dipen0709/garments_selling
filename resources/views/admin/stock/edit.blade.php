@extends('app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stock
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$title}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title}}</h3>
            </div>
            <div class="box-body">
                <form class="forms-sample" id="stocks" name="stocks" method="POST" enctype="multipart/form-data" action="{{ route('stock.update')}}"
                      autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Serial No</label>
                                <input type="text" maxlength="50" class="form-control" id="serial_no" name="serial_no" placeholder=" Serial No" value="{{ $data->serial_no }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kapad</label>
                                <input type="text" class="form-control p-input" id="kapad" name="kapad" placeholder="Kapad" value="{{ $data->kapad }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Size (X,XL,XXL)</label>
                                <input type="text" class="form-control p-input" id="size" name="size" placeholder="Size" value ="{{$data->size}}">
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Order Date</label>                        
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" class="form-control p-input" id="order_date" name="order_date"  value="{{date('m/d/Y', strtotime($data->order_date))}}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" >
                        <button type="submit" class="btn btn-info  btn-success">Update</button>
                    </div> 
                      
                </form> 
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection