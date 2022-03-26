<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::get();
        return view('customers.customers',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'inputNameCustomer' => 'required',
            'inputCodeCustomer' => 'required',
            'inputAddressCustomer' => 'required',
            'inputPhoneCustomer' => 'required',
            'inputEmailCustomer' => 'required',
            
        ]);
        $msg="";
        $error=false;
        
        $count = Customer::where('code', $request->input('inputCodeCustomer'))->count();
        if ($count>0) {
            $msg="El codigo ya existe, intente con otro.";
            $error=true;
            
        }else{
            $user=Customer::create([
                'name' => $request->input('inputNameCustomer'),            
                'code' => $request->input('inputCodeCustomer'),
                'address' => $request->input('inputAddressCustomer'),
                'phone' => $request->input('inputPhoneCustomer'),
                'email' => $request->input('inputEmailCustomer'),
                
            ]);
            
            $user->save();
               
        }

        $array=["msg"=>$msg, "error"=>$error];
        
        return response()->json($array);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        $user = Customer::find($customer);
        $user->delete();
        return redirect()->route('customers.index');
    }
}
