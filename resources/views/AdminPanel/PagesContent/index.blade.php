@extends('AdminPanel.layouts.main')
@section('content')

<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        @include('AdminPanel.layouts.messages')

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
