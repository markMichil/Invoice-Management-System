<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;

        $this->pageTitle = 'Customer Page';
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = $this->customerRepository->all($request);
            return datatables()->of($customers)
                ->addColumn('control', function ($customer) {
                    return '<a class="btn btn-success" href="'.route('customers.show', $customer).'">View</a>

                        ';
                })
                ->rawColumns(['control'])
                ->make(true);
        }

        return view('AdminPanel.PagesContent.Customers.index')->with('pageTitle', $this->pageTitle);
    }

    public function show($id)
    {
        $data =  $this->customerRepository->find($id);

        if($data['status']){
            return view('AdminPanel.PagesContent.Customers.show')
                ->with('customer',$data['data'])
                ->with('pageTitle', $this->pageTitle);
        }else{
            $error[] = $data['msg'];
            return redirect()->back()
                ->with('pageTitle', $this->pageTitle)
                ->with('errors',$error);
        }


    }


}
