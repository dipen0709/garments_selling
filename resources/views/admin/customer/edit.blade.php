@extends('app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
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
                <form class="forms-sample" id="customers" name="customers" method="POST" enctype="multipart/form-data" action="{{ route('customer.update')}}"
                      autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder=" Name" value="{{ $data->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control p-input " id="email" name="email" value="{{ $data->email }}">       
                        </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" maxlength="10" class="form-control p-input" id="mobile" name="mobile" placeholder="Mobile No" value="{{ $data->mobile }}">
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