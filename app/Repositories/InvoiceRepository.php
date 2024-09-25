<?php

namespace App\Repositories;
use App\Models\Invoice;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Traits\GeneralTrait;

use Illuminate\Support\Facades\Log;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    use GeneralTrait;

    public function all($request,$resource='api')
    {
        if($resource == 'api'){
            $paginate = (isset($request->paginate))?$request->paginate:10;

            return $this->filterAllInvoices($request)->paginate($paginate);
        }
            return invoice::query()
                ->with('user:id,name')
                ->with('customer:id,name')
                ->get();

    }

    public function find($id)
    {
        try{
            $invoice =  Invoice::findOrFail($id);
            return ['status'=>true,'msg'=>'','data'=>$invoice];

        }catch (\Exception $exception){
            Log::error('InvoiceRepository.find : '.$exception->getMessage());
            return ['status'=>false,'msg'=> $exception->getMessage(),'data'=> []];

        }



    }

    public function create(array $data)
    {

        $data['user_id'] = auth()->user()->id;

        $invoice =  Invoice::create($data);

        // Log the 'create' action
        $this->logAction('create', $invoice);

        return $invoice;
    }

    public function update($id, array $data)
    {
        try{
            $invoice = Invoice::findOrFail($id);
            $data['user_id'] = auth()->user()->id;
            $invoice->update($data);
            // Log the 'update' action
            $this->logAction('update', $invoice);

            return ['status'=>true,'msg'=>'','data'=>$invoice];

        }catch (\Exception $exception){


            Log::error('InvoiceRepository.update : '.$exception->getMessage());
            return ['status'=>false,'msg'=> $exception->getMessage(),'data'=> []];
        }

    }

    public function delete($id)
    {


        try{
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();

            // Log the 'delete' action
            $this->logAction('delete', $invoice);
            return ['status'=>true,'msg'=>'','data'=>$invoice];

        }catch (\Exception $exception){
            return ['status'=>false,'msg'=>$exception->getMessage(),'data'=>[]];
        }
    }


    public function filterAllInvoicesApi($request)  //Filter All Invoices
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


    public function updateDeliveryStatus($id, $status)
    {
        try{
            $invoice = Invoice::findOrFail($id);
            $invoice->delivery_status = $status;
            $invoice->save();
            // Log the 'update' action
            $this->logAction('update', $invoice);

            // Send notification email to the customer
            $this->notifyCustomer($invoice);

            return ['status'=>true,'msg'=>'Updated Delivery Status Successfully','data'=>$invoice];

        }catch (\Exception $exception){
            return ['status'=>false,'msg'=>$exception->getMessage(),'data'=>$invoice];


        }
    }
}
