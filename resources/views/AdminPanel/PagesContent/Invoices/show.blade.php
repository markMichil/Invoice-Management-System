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
                            <th>  Invoice Serial :</th>
                            <td>{{$invoice->serial_number}}</td>
                        </tr>
                        <tr>
                            <th>  Delivery Status :</th>
                            <td>{{$invoice->delivery_status}}</td>
                        </tr>

                        <tr>
                            <th>  Invoice Date :</th>
                            <td>{{$invoice->invoice_date}}</td>
                        </tr>



                        <tr>
                            <th>  Customer Name :</th>
                            <td>{{$invoice->customer->name}}</td>
                        </tr>


                        <tr>
                            <th>Description :</th>
                            <td>{!! $invoice->description !!}</td>
                        </tr>


                        <tr>
                            <th> Invocie Amount :</th>
                            <td>{{$invoice->amount}}</td>
                        </tr>

                        <tr>
                            <th> Status :</th>
                            <td>{{$invoice->status}}</td>
                        </tr>


                        <tr>
                            <th> Created By  :</th>
                            <td>{{$invoice->user->name}}</td>
                        </tr>


                        <tr>

                            <th>Control</th>
                            <td>
                                <a href="{{route('invoices.edit',$invoice)}}"
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
