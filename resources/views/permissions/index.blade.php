@extends('layouts.master')
@section('title')
<title> Roles | Permissions </title>
@endsection
@section('page-wise-css')
@endsection
@section('css')
<style>
    
</style>
@endsection
@section('content')
   
<a class="btn btn-lg btn-primary m-2" href="{{route('permissions.create')}}">Create Permissions</a>

  <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Permissions</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="fixed-header" class="table table-bordered table-striped align-middle nowrap w-100">
                            <thead class="table-light">
       <tr>
        <th>ID</th>
        <th>Permissions Name</th>
        <th>Actions</th>
    </tr>
 </thead>
                            <tbody id="permissions">
@foreach($permissions as $permission)

<tr>
    <td>{{$permission->id}}</td>
    <td>{{$permission->name}}</td>
   
    <td>
       
        <form style="display: inline" action="{{route('permissions.destroy',$permission)}}" method="POST">
             @csrf
             @method('DELETE')
             <button class="btn btn-sm btn-danger" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
















@endsection

@section('page-wise-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
@endsection
@section('script')
<script>

</script>
@endsection