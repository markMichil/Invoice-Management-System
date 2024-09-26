@extends('AdminPanel.layouts.main')
@section('content')

    @if(auth()->user()->role === 'ADMIN')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{ route('invoices.create') }}">Create</a>
            </h3>
        </div>
    </div>
    @endif

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

    <script>
        function deleteInvoice(id) {
            if (confirm("Are you sure you want to delete this invoice?")) {
                $.ajax({
                    url: '/invoices/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Include the CSRF token for security
                    },
                    success: function(result) {
                        // If successful, reload the DataTable
                        $('#example1').DataTable().ajax.reload();
                        alert('Invoice deleted successfully!');
                    },
                    error: function(xhr) {
                        alert('Failed to delete the invoice.');
                    }
                });
            }
        }
    </script>


@endsection
