<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::create($request->all());

        if ($customer) {
            return to_route('invoice');
        } else {
            throw ValidationException::withMessages([
                'message' => 'Customer creation failed'
            ]);
        }
    }
}
