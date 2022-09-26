<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllCustomerContacts() {
        // logic to get all students goes here
        $customer = Customer::get();
        return response($customer, 200);
    }

    public function createCustomerContact(Request $request) {
        // logic to create a student record goes here

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
        // logic to get a student record goes here
        if (Customer::where('id', $id)->exists()) {

            $customer = Customer::where('id', $id)->get();

            return response($customer, 200);
        } else {

            return response()->json([
                "message" => "customer number not found."
            ], 404);

        }
    }

    public function updateCustomerContact(Request $request, $id) {
        // logic to update a student record goes here
        if (Customer::where('id', $id)->exists()) {

            $customer = Customer::find($id);

            $customer->contact_number = is_null($request->contact_number) ? $customer->contact_number : $request->contact_number;
            $customer->status_code = is_null($request->status_code) ? $customer->status_code : $request->status_code;
            $customer->is_whitelisted = is_null($request->is_whitelisted) ? $customer->is_whitelisted : $request->is_whitelisted;

            $customer->save();

            return response()->json([
                "message" => "customer number records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "customer contact not found"
            ], 404);

        }
    }

    public function deleteCustomerContact ($id) {
        // logic to delete a student record goes here
        if(Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $customer->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {

            return response()->json([
                "message" => "customer contact  not found"

            ], 404);
        }


    }



    public function blacklistCustomerContact(Request $request, $id) {
        // logic to update a student record goes here
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);

            $customer->contact_number = is_null($request->contact_number) ? $customer->contact_number : $request->contact_number;
            $customer->status_code = is_null($request->status_code) ? $customer->status_code : $request->status_code;
            $customer->is_whitelisted = 0;

            $customer->save();

            return response()->json([
                "message" => "customer number records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "customer contact not found"
            ], 404);

        }
    }
}
