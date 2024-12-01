@extends('layout')


@section('title')
    Update User Data
@endsection

@section('content')
    <form action="{{ route('user.update', $users->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <pre>
            @php
                
                print_r($errors->all())
            @endphp
        </pre> --}}
        <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" value="{{ $users->name }}" name="username">
        </div>
        <div class="mb-3">
            <label for="useremail" class="form-label">User Email</label>
            <input type="email" class="form-control" value="{{ $users->email }}" name="useremail">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">User Age</label>
            <input type="number" class="form-control" value="{{ $users->age }}" name="userage">
        </div>
        <div class="mb-3">
            <label for="usercity" class="form-label">User City</label>
            <input type="text" class="form-control" value="{{ $users->city }}" name="usercity">
        </div>
        <div class="mb-3">
            <input type="submit" value="Save" class="btn btn-success">
        </div>
    </form>
@endsection
