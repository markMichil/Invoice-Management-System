<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all($request)
    {
        $paginate = (isset($request->paginate))?$request->paginate:10;

        return $this->filterAllCustomers($request)->get();
    }


    public function find($id)
    {
        try{
           $customer =  Customer::with('invoice')->findOrFail($id);
            $data = ['status'=>true,'msg'=>'','data'=>$customer];
            return $data;

        }catch (\Exception $exception){
            Log::error('InvoiceRepository.find : '.$exception->getMessage());
            return  ['status'=>false,'msg'=>$exception->getMessage(),'data'=>[]];
        }



    }

    private function filterAllCustomers($request)  //Filter All Customers
    {
        $query = Customer::query();


        return $query;

    }
}
