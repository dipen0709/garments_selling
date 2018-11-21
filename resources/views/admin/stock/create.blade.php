@extends('app')

@section('content')
<div class="content-wrapper" >   
    <section class="content-header">
        <h1>
            Stock
            <small>Create</small>
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
                <form class="forms-sample" id="stock" name="stock" method="POST" enctype="multipart/form-data" action="{{ route('stock.store')}}"
                      autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                        <label>Serial Name</label> 
                        <select id="serial_id" name="serial_id" class="form-control m-b-sm">
                            <option value="0">Select Serial Name</option>
                              @if(!empty($sizewithprices))
                              @foreach($sizewithprices as $avg)
                              <option value="{{$avg->id}}">{{$avg->serial_name}}</option>
                              @endforeach
                              @endif
                        </select>
                    </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kapad</label>
                                <input type="text" class="form-control p-input" id="kapad" name="kapad" placeholder="Kapad">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Size (X,XL,XXL)</label>
                                <input type="text" class="form-control p-input" id="size" name="size" placeholder="Size">
                            </div>
                        </div>   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control p-input" id="Quantity" name="qty" placeholder="Quantity">
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Order Date</label>                        
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" class="form-control p-input" id="order_date" name="order_date"  value="">
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
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" >

</script>
@endsection