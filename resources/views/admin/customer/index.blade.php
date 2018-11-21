@extends('app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Management
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customer Management</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header ">
                 @if (session()->has('success'))
                    <h4 style="text-align: center; color: green;">{{ session('success') }}</h4>
                 @endif
              <h3 class="box-title pull-right"> <a href="{{route('customer.create')}}" class="btn btn-block btn-primary">Add Customer</a></h3>
            </div>
            <div class="box-body">
              <table id="datatable_catgory" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>                 
                  <th>Email</th>
                  <th>Mobile</th>                  
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(!empty($customer) && $customer->count() > 0)
                    @foreach($customer as $key => $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->mobile}}</td>                                            
                        <td>{{date("M j, Y h:i A",strtotime($value->created_at))}}</td>
                        <td><a href="{{ route('customer.edit',array('id'=>$value->id))}}" rel="tooltip" title="" class="btn btn-default btn-xs" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('customer.delete',array('id'=>$value->id))}}" rel="tooltip" title="" class="btn btn-default btn-xs" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
</div>
<script src="{{ asset('/public/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/js/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $('#datatable_catgory').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  
   function deleteconfirm(str){
    if(confirm(str)){
        return true;
    }
    return false;
}
</script>

@endsection