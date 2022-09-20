@extends('layout.master')
@section('content')
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage Employees</h2>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-dark add">Add Employee</button>
                        </div>
                    </div>
                </div>
                <table id="employees-table" class="table table-bordered" style="font-size: 12px!important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('models.employee')
@endsection
@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
    $('#employees-table').dataTable({
        ajax: '/employees/data',
        processing: true,
        serverSide: true,
        stateSave: true,
        order: [[0, "desc"]],
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on('click', '.add, .edit', function () {
        const modal = $('#employee-modal');
        const form = modal.find('form');
        form.trigger('reset');
        const isEdit = $(this).hasClass('edit');
        const tr = $(this).closest('tr');
        const rowData = $('#employees-table').DataTable().row(tr).data();
        $('#employee-id').val(isEdit ? rowData.id : '');
        $('#name').val(isEdit ? rowData.name : '');
        $('#email').val(isEdit ? rowData.email : '');
        $('#phone_no').val(isEdit ? rowData.phone_no : '');
        $('#address').val(isEdit ? rowData.address : '');
        modal.modal('show');
    });

    </script>
@endsection


