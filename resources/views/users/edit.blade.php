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
   




<div class="fs-4">
    <h2>Edit User Roles</h2>

<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>

<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')

    <h4>Roles</h4>
    @foreach($roles as $role)
        <div>
            <input type="checkbox"
                   name="roles[]"
                   value="{{ $role->name }}"
                   {{ $user->hasRole($role->name) ? 'checked' : '' }}>
            {{ $role->name }}
        </div>
    @endforeach

    <button class="btn btn-md btn-primary" type="submit">Update Roles</button>
</form>




</div>



@endsection

@section('page-wise-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
@endsection
@section('script')
<script>

</script>
@endsection