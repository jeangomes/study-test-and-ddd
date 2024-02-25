<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\ProcessDataPurchase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function create(): View
    {
        return view('purchase.create');
    }

    public function index(): JsonResponse
    {
        $purchases = Purchase::query()->withCount('items')->orderBy('purchased_at')->get();
        return response()->json(['purchases' => $purchases]);
        //return view('purchase.index', ['purchases' => $purchases]);
    }

    public function show(Purchase $purchase): JsonResponse
    {
        $purchase->load(['items' => function ($query) {
            $query->orderBy('id');
        }]);
        return response()->json(['purchase' => $purchase]);
        //return view('purchase.show', ['purchase' => $purchase]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $purchase = new Purchase();
            $purchase->store = $request->input('store');
            $purchase->purchased_at = $request->input('purchased_at');
            $purchase->paid_at = $request->input('purchased_at');
            $purchase->amount = $request->input('amount');
            $purchase->tax = $request->input('tax');
            $purchase->nfce_key_access = $request->input('nfce_key_access');
            $purchase->save();
            $make = new ProcessDataPurchase();
            $records = $make->handle($request->input('content_write'));
            $purchase->items()->createMany($records);
        });
        //return redirect('/purchase');
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ], 201);
    }
}
