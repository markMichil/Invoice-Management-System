@extends('AdminPanel.layouts.main')
@section('content')

<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        @include('AdminPanel.layouts.messages')
        @if(count($messages) > 0)
        <form id="deleteForm" action="{{ route('deleteMessage') }}" method="post">
            @csrf
            @method('delete')

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="selectedMessages[]" value="{{ $item->id }}">
                        </td>
                        <td>{{ $item->id }}</td>
                        <td width="150">{{ $item->name }}</td>
                        <td width="150">{{ $item->email }}</td>
                        <td width="150">{{ $item->subject }}</td>
                        <td width="150">{{ $item->message }}</td>
                        <td class="text-center">
                            @if($item->is_read == 0)
                            <a class="btn btn-dark" href="{{ route('viewedMessage', $item) }}">Mark Read</a>
                            @endif
                            <button type="button" class="btn btn-danger btn-delete">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Control</th>
                    </tr>
                </tfoot>
            </table>

            <button type="button" class="btn btn-danger btn-delete-multiple">Delete Selected</button>
        </form>
        @else
        <h1 class="text-center">NO DATA</h1>
        @endif
    </div>
    <!-- /.card-body -->
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add click event listener to the delete button
        document.querySelector(".btn-delete-multiple").addEventListener("click", function () {
            // Trigger the form submission when the delete button is clicked
            document.getElementById("deleteForm").submit();
        });
    });
</script>

    
    
    
    
    
@endsection
