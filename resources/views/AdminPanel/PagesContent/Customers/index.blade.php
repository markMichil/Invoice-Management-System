@extends('AdminPanel.layouts.main')
@section('content')



    <div class="card">
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Has Invoices</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                <!-- DataTables will fill this with AJAX -->
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Has Invoices</th>
                    <th>Control</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- DataTables JS -->
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customers.index') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'phone' },
                    { data: 'email' },
                    { data: 'invoice_count' },
                    { data: 'control', orderable: false, searchable: true }
                ]
            });
        });
    </script>

@endsection
