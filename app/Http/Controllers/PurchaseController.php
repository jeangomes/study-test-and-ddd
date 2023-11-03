<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\ProcessDataPurchase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function create(): View
    {
        return view('purchase.create');
    }

    public function index(): View
    {
        $purchases = Purchase::all();
        return view('purchase.index', ['purchases' => $purchases]);
    }

    public function show(Purchase $purchase): View
    {
        $purchase->load('items');
        return view('purchase.show', ['purchase' => $purchase]);
    }

    public function store(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $purchase = new Purchase();
            $purchase->store = 'Sacolão (Rede Qualy)';
            $purchase->purchased_at = $request->input('purchased_at');
            $purchase->paid_at = $request->input('purchased_at');
            $purchase->amount = $request->input('amount');
            $purchase->tax = $request->input('tax');
            $purchase->nfce_key_access = $request->input('nfce_key_access');
            $purchase->save();
            $make = new ProcessDataPurchase();
            $records = $make->handle($request->input('content'));
            $purchase->items()->createMany($records);
        });
        return redirect('/purchase');
    }
}
