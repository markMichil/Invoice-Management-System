@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{isset($board)?'Edit '.$board->name :'ADD'}}</li>
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
                        <form action="{{(isset($board))?route('board.update',$board):route('board.store')}}"
                              method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($board)?method_field('PUT'):''}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Enter Name"
                                           value="@if(old('name')){{old('name')}}@elseif(isset($board->name)){{$board->name}}@endif"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Arabic Name</label>
                                    <input type="text" name="name_ar" class="form-control"
                                           placeholder="Enter Arabic  Name"
                                           value="@if(old('name_ar')){{old('name_ar')}}@elseif(isset($board->name_ar)){{$board->name_ar}}@endif"
                                           required>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="description">Description </label>--}}
{{--                                    <textarea class="textarea form-control" placeholder="Place some text here"--}}
{{--                                              name="description"--}}
{{--                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  placeholder="Enter text" required>@if(old('description')){{old('description')}}@elseif(isset($board->description)){{$board->description}}@endif</textarea>--}}
{{--                                </div>  --}}



                                <div class="form-group">
                                    <label for="description">Description </label>
                                    <textarea class="menubar" class=" form-control" placeholder="Place some text here"
                                              name="description" required>
                                        @if(old('description')){{old('description')}}@elseif(isset($board->description)){{$board->description}}@endif
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Arabic Description  </label>
                                    <textarea class="menubar" class=" form-control" placeholder="Place some text here"
                                              name="description_ar" required>
                                        @if(old('description_ar')){{old('description_ar')}}@elseif(isset($board->description_ar)){{$board->description_ar}}@endif
                                    </textarea>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="description">Arabic Description </label>--}}
{{--                                    <textarea class="textarea form-control" placeholder="Place some Arabic text here"--}}
{{--                                              name="description_ar"--}}
{{--                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  placeholder="Enter text" required>@if(old('description_ar')){{old('description_ar')}}@elseif(isset($board->description_ar)){{$board->description_ar}}@endif</textarea>--}}
{{--                                </div>--}}



                                <div class="form-group">
                                    <label for="author_image">Member Image</label>
                                    <input type="file" class="form-control" name="author_image"  @if(!isset($board))required @endif>
                                    @if(isset($board->author_image))
                                        <br>
                                        <img src="{{url($board->author_image)}}" width="250" height="250">
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
