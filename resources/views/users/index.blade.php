@extends('layouts.master')
@section('title')
<title> Users </title>
@endsection
@section('page-wise-css')
@endsection
@section('css')
<style>
    
</style>
@endsection

@section('content')


<a class="btn btn-lg btn-primary my-2" href="{{ route('users.create') }}">Create User</a>


 <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="fixed-header" class="table table-bordered table-striped align-middle nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="users">
                               

                                           @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
            <td class="text-center">
                @can('users.edit')
                <a  class="btn btn-sm btn-info" href="{{ route('users.edit', $user) }}">
                    <i class="ri-eye-line"></i>
                    Edit</a>
                @endcan

                @can('users.delete')
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
                     <i class="ri-delete-bin-line"></i>    
                        Delete
                    </button>
                </form>
                @endcan
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
