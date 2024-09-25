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
                            <th>  Title :</th>
                            <td>{{$News->title}}</td>
                        </tr>


                        <tr>
                            <th>Description :</th>
                            <td>{!! $News->description !!}</td>
                        </tr>


                        <tr>
                            <th> Image :</th>
                            <td><img src="{{url($News->image)}}" width="200" height="200"></td>
                        </tr>


                        <tr>

                            <th>Control</th>
                            <td>
                                <a href="{{route('news.edit',$News)}}"
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
