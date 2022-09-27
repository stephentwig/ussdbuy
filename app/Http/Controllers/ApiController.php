<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllCustomerContacts() {
       
        $customer = Customer::get();
        return response($customer, 200);
    }

    public function createCustomerContact(Request $request) {
       

        $customer = new Customer;

        $customer->contact_number = $request->contact_number;
        $customer->status_code = $request->status_code;
        $customer->is_whitelisted = $request->is_whitelisted;

        $customer->save();

        return response()->json([
            "message" => "customer nubmer added."
        ], 201);
    }

    public function getCustomerContact($id) {
       
        if (Customer::where('id', $id)->exists()) {

            $customer = Customer::where('id', $id)->get();

            return response($customer, 200);
        } else {

            return response()->json([
                "message" => "customer number not found."
            ], 404);

        }
    }

    public function is_blacklisted($contact_number) {
       
        if (Customer::where('contact_number', $contact_number)->exists()) {

            $customer = Customer::where('contact_number', $contact_number)->get()->first();
            
            
            return response()->json([
                "contact_number" => $customer->contact_number,
                "status_code" => $customer->status_code,
                "message" => $customer->is_whitelisted == 1 ? "active" : "blocked"
            ], 200);


        } else {

            return response()->json([
                "message" => "customer number not found."
            ], 404);

        }
    }

    public function updateCustomerContact(Request $request, $id) {
        
        if (Customer::where('id', $id)->exists()) {

            $customer = Customer::find($id);

            $customer->contact_number = is_null($request->contact_number) ? $customer->contact_number : $request->contact_number;
            $customer->status_code = is_null($request->status_code) ? $customer->status_code : $request->status_code;
            $customer->is_whitelisted = is_null($request->is_whitelisted) ? $customer->is_whitelisted : $request->is_whitelisted;

            $customer->save();

            return response()->json([
                "message" => "customer number records updated successfully."
            ], 200);
        } else {
            return response()->json([
                "message" => "customer contact not found."
            ], 404);

        }
    }

    public function deleteCustomerContact ($id) {
       
        if(Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $customer->delete();

            return response()->json([
                "message" => "records deleted."
            ], 202);
        } else {

            return response()->json([
                "message" => "customer contact  not found."

            ], 404);
        }


    }



    public function blacklistCustomerContact(Request $request, $id) {
        
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);


            $customer->is_whitelisted = 0;

            $customer->save();

            return response()->json([
                "message" => "customer number blacklisted."
            ], 200);
        } else {
            return response()->json([
                "message" => "customer contact not found."
            ], 404);

        }
    }
}
