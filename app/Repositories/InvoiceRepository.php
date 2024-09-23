<?php

namespace App\Repositories;
use App\Models\Invoice;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Traits\ResponseMessageTrait;
use Illuminate\Support\Facades\Log;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    use ResponseMessageTrait;

    public function all($request)
    {
        $paginate = (isset($request->paginate))?$request->paginate:10;

        $invoices = $this->filterAllInvoices($request)
                                            ->paginate($paginate);

        return $this->responseMessage(200, true, null, $invoices);
    }

    public function find($id)
    {
        try{
            $invoice =  Invoice::findOrFail($id);
            return $this->responseMessage(200, true, null, $invoice);
        }catch (\Exception $exception){
            Log::error('InvoiceRepository.find : '.$exception->getMessage());
            return $this->responseMessage(400, false, $exception->getMessage(), []);
        }



    }

    public function create(array $data)
    {

        $data['user_id'] = auth()->user()->id;

        $invoice =  Invoice::create($data);
        return $this->responseMessage(200, true, null, $invoice);
    }

    public function update($id, array $data)
    {
        try{
            $invoice = Invoice::findOrFail($id);
            $data['user_id'] = auth()->user()->id;
            $invoice->update($data);
            return $this->responseMessage(200, true, "Updated Successfully", $invoice);
        }catch (\Exception $exception){
            return $this->responseMessage(500, false, 'An error occurred', $exception->getMessage());

        }

    }

    public function delete($id)
    {


        try{
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();

            return $this->responseMessage(200, true, "Invoice Delete Successfully ", $invoice);
        }catch (\Exception $exception){
            return $this->responseMessage(500, false, 'An error occurred', $exception->getMessage());

        }
    }


    public function filterAllInvoices($request)  //Filter All Invoices
    {
        $query = Invoice::query();


        $invoices = $query;

        if ($request->search) {
            $invoices = $query->where('serial_number', 'like', '%' . $request->search . '%');
        }

        if ($request->customer_id) {
            $invoices = $query->where('customer_id', $request->customer_id);
        }

        if ($request->type) {
            $invoices = $query->where('status', $request->type);
        }


        return $invoices
            ->with('user:id,name')
            ->with('customer:id,name');

    }

}
