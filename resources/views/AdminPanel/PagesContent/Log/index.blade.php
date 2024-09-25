@extends('AdminPanel.layouts.main')
@section('content')

<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        @include('AdminPanel.layouts.messages')
        @if(count($data) > 0)
        <form id="deleteForm" action="#" method="post">
            @csrf
            @method('delete')

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>#</th>
                        <th>invoice serial </th>
                        <th>User name</th>
                        <th>Role</th>
                        <th>Action </th>
                        <th>Date </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>

                        <td>{{ $item->id }}</td>
                        <td width="150">{{ $item->invoice->serial_number }}</td>
                        <td width="150">{{ $item->user->name }}</td>
                        <td width="150">{{ $item->user_role }}</td>
                        <td width="150">{{ $item->action }}</td>
                        <td width="150">{{ $item->created_at->format('Y/M/d h:i:s A') }}</td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Invoice serial </th>
                        <th>User name</th>
                        <th>Role</th>
                        <th>Action </th>
                        <th>Date </th>
                    </tr>
                </tfoot>
            </table>

        </form>



            <!-- Add pagination links -->
            <div class="d-flex justify-content-center">
            {{ $data->links('vendor.pagination.bootstrap-4') }} <!-- Custom pagination view -->
            </div>

        @else
        <h1 class="text-center">NO DATA</h1>
        @endif
    </div>
    <!-- /.card-body -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#example1').DataTable({
            paging: false // Disable DataTables pagination
        });
    });
</script>

@endsection
