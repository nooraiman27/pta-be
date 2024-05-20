@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">

<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Student</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>
    <h2>Students</h2>
    <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">Add Student</a>

    <form action="{{ route('student.bulk-delete') }}" method="POST">
        @csrf
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="submit" class="btn btn-sm btn-danger">Delete Selected</button>
    </form>
</div>
@endsection

@section('javascripts')

<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

<script>
    $(function() {

        // datatable
        $('#datatable').DataTable({
            'processing': true,
            'serverSide': true,
            'ajax': "{{ route('student.datatable') }}",
            'columns': [
                {data: 'checkbox'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {
                    data: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            'columnDefs': [
                { 'orderable': false, 'targets': 0 },
                { 'orderable': false, 'targets': 1 }
            ]
        });


        // bulk delete
        $('#select-all').click(function() {
            $('.select-row').prop('checked', this.checked);
        });

        $('#datatable tbody').on('click', '.select-row', function() {
            if ($('.select-row').length == $('.select-row:checked').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        });

    })
</script>
@endsection
