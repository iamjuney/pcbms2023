<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SupplierCreateRequest;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function index(): Response
    {
        $suppliers = Supplier::select(['supp_id', 'company', 'contact_person', 'sex', 'phone', 'address', 'created_at', 'updated_at'])->get();

        return Inertia::render('Suppliers', [
            'suppliers' => $suppliers
        ]);
    }

    public function store(SupplierCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $supplier = Supplier::create([
            'company' => $validated['company'],
            'contact_person' => $validated['contact_person'],
            'sex' => $validated['sex'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        if ($supplier) {
            // Supplier creation was successful
            return to_route('suppliers');
        } else {
            // Supplier creation failed
            throw ValidationException::withMessages([
                'message' => 'Supplier creation failed'
            ]);
        }
    }

    public function update(SupplierCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $supplier = Supplier::find($request->route('supp_id'));

        $supplier->company = $validated['company'];
        $supplier->contact_person = $validated['contact_person'];
        $supplier->sex = $validated['sex'];
        $supplier->phone = $validated['phone'];
        $supplier->address = $validated['address'];

        $supplier->save();

        return to_route('suppliers');
    }

    public function edit(Request $request): Response
    {
        $supplier = Supplier::find($request->route('supp_id'));

        return Inertia::render('SupplierEdit', [
            'supplier' => $supplier
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $supplier = Supplier::find($request->route('supp_id'));

        $supplier->delete();

        return to_route('suppliers');
    }
}
