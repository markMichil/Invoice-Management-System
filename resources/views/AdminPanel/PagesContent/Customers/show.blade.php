@extends('AdminPanel.layouts.main')
@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3><i class="fa fa-hospital-o"></i> <a href="{{route('adminDashboard')}}"> Home </a> / View

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
                            <td>{{$customer->name}}</td>
                        </tr>

                        <tr>
                            <th>  Phone :</th>
                            <td>{{$customer->phone}}</td>
                        </tr>

                        <tr>
                            <th>Email : </th>
                            <td>{{ $customer->email }}</td>
                        </tr>

                        <tr>
                            <th>invoice Count :</th>
                            <td>{{ $customer->invoice_count }}</td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
