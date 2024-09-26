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
                                    <label for="name">Customer</label>

                                    <select name="customer_id" class="form-control">
                                        <option disabled {{(isset($invoice->customer_id))?'':'selected'}}> choose Customer type</option>
                                        @if(count($customers)>0)
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}" {{(isset($invoice->customer_id) && $invoice->customer_id ==$customer->id )?'selected':''}})> {{$customer->name}}</option>
                                            @endforeach


                                        @else
                                            <option disabled> Add Customer First</option>
                                        @endif

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control"
                                           placeholder="Enter Invoice Amount"
                                           value="@if(old('amount')){{old('amount')}}@elseif(isset($invoice->amount)){{$invoice->amount}}@endif"
                                           min="0" step="0.01" required>
                                </div>


                                <div class="form-group">
                                    <label for="description">Description </label>
                                    <textarea class="menubar" class=" form-control" placeholder="Place some text here"
                                              name="description" required>
                                        @if(old('description')){{old('description')}}@elseif(isset($invoice->description)){{$invoice->description}}@endif
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="name">Invoice Date @if(old('invoice_date')){{old('invoice_date')}}@elseif(isset($invoice->invoice_date)){{date('y-m-d', strtotime($invoice->invoice_date))}}@endif</label>
                                    <input type="date" name="invoice_date" class="form-control"
                                           placeholder="Enter start date"
                                           value="@if(old('invoice_date')){{old('invoice_date')}}@elseif(isset($invoice->invoice_date)){{date('Y-m-d', strtotime($invoice->invoice_date))}}@endif"
                                    >
                                </div>

                                @if(isset($invoice->delivery_status))


                                    <div class="form-group">
                                        <label for="name">Delivery Status</label>

                                        <select name="delivery_status" class="form-control">
                                            <option disabled {{(isset($invoice->delivery_status))?'':'selected'}}> choose Delivery Statsus</option>


                                                    <option value="PENDING" {{(isset($invoice->delivery_status) && $invoice->delivery_status =='PENDING' )?'selected':''}})> PENDING </option>
                                                    <option value="CONFIRMED" {{(isset($invoice->delivery_status) && $invoice->delivery_status =='CONFIRMED' )?'selected':''}})> CONFIRMED </option>
                                                    <option value="ON_THE_WAY" {{(isset($invoice->delivery_status) && $invoice->delivery_status =='ON_THE_WAY' )?'selected':''}})> ON_THE_WAY </option>
                                                    <option value="DELIVERED" {{(isset($invoice->delivery_status) && $invoice->delivery_status =='DELIVERED' )?'selected':''}})> DELIVERED </option>

                                        </select>

                                    </div>
                                    @endif

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
