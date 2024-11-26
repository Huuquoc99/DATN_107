<?php

namespace App\Http\Controllers\Client;

use App\Models\Voucher;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyVoucherRequest;

class VoucherController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::where('is_active', 1)->get();
        $vouchers = Voucher::query()->active()->whereColumn('used_quantity', '<', 'quantity')->get();
        // dd($vouchers);
        return view('client.vouchers', compact('catalogues', 'vouchers'));
    }

    public function applyVoucher(ApplyVoucherRequest $request)
    {
        // clear session voucher
        session()->forget('voucher');
        $voucher = Voucher::query()->active()->where('code', $request->code)->first();
        if (!$voucher) {
            return response()->json(['message' => 'Mã giảm giá không tồn tại'], 404);
        }

        if ($voucher->used_quantity >= $voucher->quantity) {
            return response()->json(['message' => 'Mã giảm giá đã hết'], 404);
        }
        session()->put('voucher', $voucher->code);
        return response()->json($voucher);
    }
}
