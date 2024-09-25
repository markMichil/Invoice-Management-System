<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Traits\ResponseMessageTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    use ResponseMessageTrait;

    protected $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->pageTitle = 'Invoices Page';
    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $invoices = $this->invoiceRepository->all($request,'web');

            return datatables()->of($invoices)
                ->addColumn('customer', function ($invoice) {
                    if ($invoice->customer) {
                        return '<a href="' . route('customers.show', $invoice->customer->id) . '">' . $invoice->customer->name . '</a>';
                    }
                    return 'N/A';
                })
                ->addColumn('user', function ($invoice) {
                    return $invoice->user ? $invoice->user->name : 'N/A';
                })
                ->addColumn('control', function ($invoice) {
                    return '<a class="btn btn-success" href="' . route('invoices.show', $invoice) . '">View</a>
                        <a class="btn btn-dark" href="' . route('invoices.edit', $invoice) . '">Edit</a>
                        <form action="' . route('invoices.destroy', $invoice) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
                })
                ->rawColumns(['customer', 'control']) // Ensure that customer and control columns render HTML
                ->make(true);
        }

        return view('AdminPanel.PagesContent.Invoices.index')->with('pageTitle', $this->pageTitle);





    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPanel.PagesContent.Invoices.form')->with('pageTitle', $this->pageTitle);

    }


    public function store(Request $request)
    {


        try {
            $data = $request->validate([
                'customer_id' => 'required|exists:customers,id', // Ensure 'exists' is correctly spelled and references the right table
                'amount' => 'required|numeric|min:1', // Check for non-negative amounts
                'description' => 'nullable|string|max:255', // Make description optional, with a maximum length
                'invoice_date' => 'required|date|date_format:Y-m-d', // Ensure date format is specified
            ], [
                'customer_id.required' => 'The customer ID is required.',
                'customer_id.exists' => 'The selected customer ID does not exist.',
                'amount.required' => 'The amount is required.',
                'amount.numeric' => 'The amount must be a number.',
                'amount.min' => 'The amount must be at least 0.',
                'description.string' => 'The description must be a string.',
                'description.max' => 'The description may not be greater than 255 characters.',
                'invoice_date.required' => 'The invoice date is required.',
                'invoice_date.date' => 'The invoice date must be a valid date.',
                'invoice_date.date_format' => 'The invoice date must be in the format Y-m-d.',
            ]);


            return $this->responseMessage(200, true, null, $this->invoiceRepository->create($data));
        } catch (ValidationException $exception) {

            return $this->responseMessage(422,false,'Validation error' ,$exception->errors());

        }
    }

    public function show($id)
    {
        dd('s');
        $data =  $this->invoiceRepository->find($id);
        if($data['status'])
            return $this->responseMessage(200, true, null, $data['data']);

        return $this->responseMessage(400, false, $data['msg'],$data['data']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $data = $request->validate([
                'status' => 'in:PAID,UNPAID', // Ensure status is either PAID or UNPAID
                'customer_id' => 'exists:customers,id', // Ensure 'exists' is correctly spelled and references the right table
                'amount' => 'nullable|numeric|min:1', // Check for non-negative amounts
                'description' => 'nullable|string|max:255', // Make description optional, with a maximum length
                'invoice_date' => 'nullable|date|date_format:Y-m-d', // Ensure date format is specified
            ], [
                'status.in' => 'The selected status must be either PAID or UNPAID.',
                'customer_id.exists' => 'The selected customer ID does not exist.',
                'amount.numeric' => 'The amount must be a number.',
                'amount.min' => 'The amount must be at least 1.',
                'description.string' => 'The description must be a string.',
                'description.max' => 'The description may not be greater than 255 characters.',
                'invoice_date.date' => 'The invoice date must be a valid date.',
                'invoice_date.date_format' => 'The invoice date must be in the format Y-m-d.',
            ]);

            // Update the invoice
            $data =  $this->invoiceRepository->update($id, $data);

            if($data['status'])
                return $this->responseMessage(200, true, "Updated Successfully",$data['data'] );


            return $this->responseMessage(400, false, $data['msg'],$data['data']);
        } catch (ValidationException $exception) {
            return $this->responseMessage(422, false, 'Validation error', $exception->errors());
        } catch (\Exception $e) {
            return $this->responseMessage(500, false, 'An error occurred', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $data =  $this->invoiceRepository->delete($id);

        if($data['status'])
            return $this->responseMessage(200, true, "Invoice Delete Successfully ", $data['data']);


        return $this->responseMessage(400, false, $data['msg'],$data['data']);
    }

    public function updateDeliveryStatus(Request $request, $id)
    {
        try{
            $request->validate([
                'delivery_status' => 'required|in:PENDING,CONFIRMED,ON_THE_WAY,DELIVERED',
            ]);

            $data =  $this->invoiceRepository->updateDeliveryStatus($id, $request->delivery_status);
            if($data['status'])
                return $this->responseMessage(200, true, "Updated Delivery Status Successfully", $data['data']);

            return $this->responseMessage(500, false, 'An error occurred '.$data['msg'] ,$data['data']);

        } catch (ValidationException $exception) {
            return $this->responseMessage(422, false, 'Validation error', $exception->errors());
        }

    }

}
