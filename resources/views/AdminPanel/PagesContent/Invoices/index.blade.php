@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{ route('invoices.create') }}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>Amount</th>
                    <th>Customer</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Delivery</th>
                    <th>Invoice Date</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                {{-- DataTables will populate this section dynamically --}}
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>Amount</th>
                    <th>Customer</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Delivery</th>
                    <th>Invoice Date</th>
                    <th>Control</th>
                </tr>
                </tfoot>
            </table>

        </div>
        <!-- /.card-body -->
    </div>



    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('invoices.index') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'id' },                         // Invoice ID
                    { data: 'serial_number' },              // Invoice Serial Number
                    { data: 'amount' },                     // Invoice Amount
                    { data: 'customer', name: 'customer' }, // Customer Name with Link
                    { data: 'user', name: 'user' },         // User Name (Flattened in controller)
                    { data: 'status' },                     // Status
                    { data: 'delivery_status' },            // Delivery Status
                    { data: 'invoice_date' },               // Invoice Date
                    { data: 'control', orderable: false, searchable: false } // Control buttons
                ]
            });
        });
    </script>
@endsection
