@extends('layouts.master')
@section('title')
    <title> Users | Roles </title>
@endsection
@section('page-wise-css')
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
   <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Roles</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="fixed-header" class="table table-bordered table-striped align-middle nowrap w-100">
                            <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Roles</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
 </thead>
                            <tbody id="users">
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @if($role->permissions && $role->permissions->count()>0)
                   @foreach($role->permissions as $permission)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success me-1 mb-1">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                        @else
                                        <span class="text-muted">No permissions</span>
                                        @endif
                </td>
                <td class="text-center">
    <div class="d-flex justify-content-center gap-1">
        @can('roles.edit')
            <a class="btn btn-sm btn-info" href="{{ route('roles.edit', $role) }}">
                 <i class="ri-eye-line"></i> Edit
            </a>
        @endcan

        @can('roles.delete')
            <form action="{{ route('roles.destroy', $role) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">
                     <i class="ri-delete-bin-line"></i> Delete
                </button>
            </form>
        @endcan
    </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection
@section('script')
    <script></script>
@endsection
