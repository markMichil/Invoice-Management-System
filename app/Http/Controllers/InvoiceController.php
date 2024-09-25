<?php
namespace App\Http\Controllers;

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
    }

    public function index(Request $request)
    {
        return $this->invoiceRepository->all($request);
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



            return $this->invoiceRepository->create($data);

        } catch (ValidationException $exception) {

            return $this->responseMessage(422,false,'Validation error' ,$exception->errors());

        }
    }

    public function show($id)
    {
        return $this->invoiceRepository->find($id);
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
        return $this->invoiceRepository->update($id, $data);

            } catch (ValidationException $exception) {
                    return $this->responseMessage(422, false, 'Validation error', $exception->errors());
                    } catch (\Exception $e) {
                        return $this->responseMessage(500, false, 'An error occurred', $e->getMessage());
            }
    }

    public function destroy($id)
    {
        return $this->invoiceRepository->delete($id);
    }

    public function updateDeliveryStatus(Request $request, $id)
    {
        try{
            $request->validate([
                'delivery_status' => 'required|in:PENDING,CONFIRMED,ON_THE_WAY,DELIVERED',
            ]);

            return  $this->invoiceRepository->updateDeliveryStatus($id, $request->delivery_status);

        } catch (ValidationException $exception) {
            return $this->responseMessage(422, false, 'Validation error', $exception->errors());
        }

    }


}
