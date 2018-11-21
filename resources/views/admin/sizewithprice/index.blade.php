@extends('app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Average
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Average Management</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header ">
                @if (session()->has('success'))
                <h4 style="text-align: center; color: green;">{{ session('success') }}</h4>
                @endif
                <h3 class="box-title pull-right"> <a href="{{route('sizewithprice.create')}}" class="btn btn-block btn-primary">Add Average</a></h3>
            </div>
            <div class="box-body">
                <table id="datatable_catgory" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-primary">
                            <th>Serial Name</th>                       
                            <th>{{trans('users.createdat')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($sizenprices) && !empty($sizenprices) && count($sizenprices) > 0)
                        @foreach($sizenprices as $data)
                        <tr class="">
                            <td>{{$data->serial_name}}</td>                   
                            <td>{{date("M j, Y h:i A",strtotime($data->created_at. ' ' . trans('users.timezone')))}} 
                            <td><a href="{{ route('sizewithprice.edit',array('id'=>$data->id)) }}" rel="tooltip" title="" class="btn btn-default btn-xs" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>
                            <td><a href="{{ route('sizewithprice.delete',array('id'=>$data->id)) }}" onclick="return deleteconfirm('Are you sure you want to delete this? \n ');" rel="tooltip" title="" class="btn btn-default btn-xs " data-original-title="Delete"><i class="fa fa-times text-danger text"></i></a></td> 
                        </tr>
                        @endforeach
                        @else
                        <tr class="">
                            <td>{{trans('users.norecords')}}</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
            {{ $sizenprices->links() }}
        </div>
    </section>
</div>
<script src="{{ asset('/public/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(function () {
        $('#datatable_catgory').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': true
        })
    })

    function deleteconfirm(str) {
        if (confirm(str)) {
            return true;
        }
        return false;
    }
</script>
@endsection