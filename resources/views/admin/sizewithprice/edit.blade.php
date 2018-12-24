@extends('app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Average
            <small>Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$title}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title}}</h3>
            </div>
            <div class="box-body">
                <form class="forms-sample" id="size_with_price" name="size_with_price" method="POST" enctype="multipart/form-data" action="{{ route('sizewithprice.update',array('id'=>$sizewithprice->id))}}"
                      autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="addDetails" id="addDetails" value="@if(count($cloth_details) > 0){{count($cloth_details)}}@else{{'1'}}@endif">
                    <input type="hidden" name="edit_sizewithprice" id="edit_sizewithprice" value="{{$sizewithprice->id}}">
                    <div class="row">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label>Serial Name</label>
                                <input type="text" class="form-control p-input" id="serial_name" name="serial_name" value="{{$sizewithprice->serial_name}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <i class="fa fa-plus-circle add_sizewithprice" style="cursor: pointer; float: left; margin: 35px 0px 10px 15px; color: dodgerblue; font-size: 14px;"> Add Size</i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row col-sm-12" >
                                <div class="col-2">
                                    <label>Size (X, XL, XXL)</label>
                                </div>
                                <div class="col-md-10"></div>
                            </div>     
                        </div>     
                        @if(count($cloth_details) > 0)
                        <div class="sizewithprice_append row col-sm-12">
                            @foreach($cloth_details as $key_i => $cloth)  
                            <?php $i = $key_i + 1; ?>
                            @if(isset($cloth->size) && isset($cloth->price))
                            <div class="div_row_{{$i}} row col-sm-12">
<?php /*                                <input type="hidden" name="total_avg_{{$i}}" id="total_avg_{{$i}}" value="{{count($cloth->avg->kapad)}}" /> */ ?>
                                <div class="col-md-2 mb-xl-3" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control p-input" id="size_{{$i}}" name="size[]" value="@if(isset($cloth->size)){{$cloth->size}}@endif">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control p-input price_validate" id="price_{{$i}}" name="price[]" value="@if(isset($cloth->price)){{$cloth->price}}@endif">
                                </div>                                
<!--                                <div class="col-md-1" >
                                    <i class="fa fa-plus-circle add_average replace_data_id_{{$i}}" style="font-size:24px; cursor: pointer;" data-id="{{$i}}"></i></div>-->

                                <div class="clearfix" ></div>
                            </div>
                            @endif 
                            @endforeach
                        </div>
                        @else
                        <div class="sizewithprice_append row col-sm-12" >
                            <div class="div_row_1 row col-sm-12">
                                <!--<input type="hidden" name="total_avg_1" id="total_avg_1" value="0" />-->
                                <div class="col-md-2 mb-xl-3" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control p-input" id="size_1" name="size[]" value="" placeholder="size">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control p-input price_validate" id="price_1" name="price[]" value="" placeholder="price">
                                </div>                                
                                <div class="col-md-1" >
                                    <i class="fa fa-plus-circle add_average replace_data_id_1" style="font-size:24px; cursor: pointer;" data-id="1"></i>
                                </div>
                                <div class="clearfix" ></div>
                                <div class="sub_row_1 row col-sm-12"></div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group"></div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-primary" href='{{route('sizewithprice')}}'>Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!--Hidden HTML-->

        <div class="row col-sm-12 sizewithprice_html hidden">
            <div class="div_row_xxxx row col-sm-12">
                <input type="hidden" name="total_avg_xxxx" id="total_avg_xxxx" value="0" />
                <div class="col-md-2 mb-xl-3" style="margin-bottom: 10px;">
                    <input type="text" class="form-control p-input" id="size_xxxx" name="size_yyyy[]" value="" placeholder="size">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control p-input price_validate" id="price_xxxx" name="price_yyyy[]" value="" placeholder="price">
                </div>
<!--                <div class="col-md-2">
                    <input type="text" class="form-control p-input price_validate" id="other_price_xxxx" name="oher_price_yyyy[]" value="" placeholder="other price">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control p-input" id="other_desc_xxxx" name="other_desc_yyyy[]" value="" placeholder="kach,button,work">
                </div>-->
<!--                <div class="col-md-1" >
                    <i class="fa fa-plus-circle add_average replace_data_id_xxxx" style="font-size:24px; cursor: pointer;" data-id="xxxx"></i>
                </div>-->
                <div class="clearfix" ></div>
                <div class="sub_row_xxxx row col-sm-12"></div>

            </div>
        </div>

        <div class="average_hidden_html hidden">
            <div class="row col-sm-12"  >
                <div class="col-md-1"></div>
                <div class="col-md-2 mb-xl-3" style="margin-bottom: 10px;">
                    <select id="kapad_id_xxxx_yyyy" name="kapad_id_xxxx[]" class="form-control m-b-sm">
                        <option value="">Select</option>
                        @if(!empty($kapad_master))
                        @foreach($kapad_master as $kapad)
                        <option value="{{$kapad->id}}">{{$kapad->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control p-input price_validate" placeholder="use kapad" id="use_kapad_xxxx_yyyy" name="use_kapad_xxxx[]" value="">
                </div>
            </div>
        </div>

    </section>
</div>
@endsection