@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{isset($invoice)?'Edit '.$invoice->name :'ADD'}}</li>
                    </ol>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{(isset($invoice))?route('invoices.update',$invoice):route('invoices.store')}}"
                              method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($invoice)?method_field('PUT'):''}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input type="text" name="title" class="form-control"
                                           placeholder="Enter title"
                                           value="@if(old('title')){{old('title')}}@elseif(isset($invoice->title)){{$invoice->title}}@endif"
                                           required>
                                </div>




                                <div class="form-group">
                                    <label for="description">Description </label>
                                    <textarea class="menubar" class=" form-control" placeholder="Place some text here"
                                              name="description" required>
                                        @if(old('description')){{old('description')}}@elseif(isset($invoice->description)){{$invoice->description}}@endif
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="name">Link</label>
                                    <input type="text" name="link" class="form-control"
                                           placeholder="Enter link"
                                           value="@if(old('link')){{old('link')}}@elseif(isset($invoice->link)){{$invoice->link}}@endif"
                                           >
                                </div>




                                <div class="form-group">
                                    <label for="author_image">Image</label>
                                    <input type="file" class="form-control" name="image"  @if(!isset($invoice)) @endif>
                                    @if(isset($invoice->image))
                                        <br>
                                        <img src="{{url($invoice->image)}}" width="250" height="250">
                                    @endif
                                </div>





                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
