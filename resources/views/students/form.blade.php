@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($student) ? 'Update' : 'Add New' }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($student) ? route('student.update', $student->id) : route('student.store') }}" method="POST">
        @csrf
        @if(isset($student))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" class="form-control" value="{{ old('phone', $student->phone ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
