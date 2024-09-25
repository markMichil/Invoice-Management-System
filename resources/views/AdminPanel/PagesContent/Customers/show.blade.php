@extends('AdminPanel.layouts.main')
@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3><i class="fa fa-hospital-o"></i> <a href="{{route('adminDashboard')}}">Home</a> / View

            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('AdminPanel.layouts.messages')
                    <table class="table table-hover table-striped">
                        <tbody>
                        <tr>
                            <th>  Name :</th>
                            <td>{{$board->name}}</td>
                        </tr>

                        <tr>
                            <th>  Arabic Name :</th>
                            <td>{{$board->name_ar}}</td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>{!! $board->description !!}</td>
                        </tr>

                        <tr>
                            <th>Arabic Description:</th>
                            <td>{!! $board->description_ar !!}</td>
                        </tr>

                        <tr>
                            <th>Member Image</th>
                            <td><img src="{{url($board->author_image)}}" width="200" height="200"></td>
                        </tr>
                        <tr>

                            <th>Control</th>
                            <td>
                                <a href="{{route('board.edit',$board)}}"
                                   class="btn  btn-primary">Edit</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
