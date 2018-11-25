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
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
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
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>Serial Name</label> 
                                    <select id="serial_id" name="serial_id" class="form-control m-b-sm">
                                        <option value="0">Select Serial Name</option>
                                        @if(!empty($sizewithprices))                                    
                                        @foreach($sizewithprices as $avg)
                                        @php $selected = ''; @endphp
                                        @if($avg->id == $data->serial_id)
                                        @php $selected = "selected='selected'"; @endphp
                                        @endif
                                        <option value="{{$avg->id}}" {{$selected}}>{{$avg->serial_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="sizewithdata-html">
                            <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>Size</label> 
                                    <select id="size" name="size" class="form-control m-b-sm">
                                        <option value="0">Select Size</option>
                                                                         
                                        @foreach($kapad as $key => $kapadsize)
                                        @if(isset($data->size))  
                                        @php $selectedsize = ''; @endphp
                                        @if($kapadsize->size == $data->size)
                                        @php $selectedsize = "selected='selected'"; @endphp
                                        @endif
                                        <option value="{{$kapadsize->size}}" {{$selectedsize}}>{{$kapadsize->size}}</option>
                                        @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-md-6">
                            <div class="form-group">
                                <label>Qty</label>                                                        
                                    <input type="text" class="form-control p-input price_validate" id="qty" name="qty"  value="{{$data->qty}}">
                           </div>
                            </div>
                        </div>
                            </div>
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
<script type="text/javascript" >

    $("#serial_id").on('change', function () {
        var Serialid = $(this).val();
        var _token = $("#_token").val();
        $.ajax({
            type: "POST",
            url: "{{url('/stock/getsizenkapad')}}",
            data: {serial_id: Serialid, _token: _token},
            success: function (html) {
//                alert(html);
                $('.sizewithdata-html').html(html);
            }
        });
    });

    $(".price_validate").keypress(function (event) {
        if ((event.which != 46 || $(this).val().indexOf() != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
        if (($(this).val().indexOf() != -1) && ($(this).val().substring($(this).val().indexOf(), $(this).val().indexOf().length).length > 2)) {
            event.preventDefault();
        }
    });

</script>
@endsection