<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function showTransactionHistory()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)->where('status',true)->with('transactionDetail.item')->get();
        if($user->is_admin)
        {
            $transactions = Transaction::where('status',true)->latest()->with('transactionDetail.item')->get();
        }
        return view('transactionHistory', ['transactions' => $transactions]);
    }
    public function showTransactionDetail(Transaction $transaction)
    {
        $transactionDetails = TransactionDetail::with('item')->where('transaction_id', $transaction->id)->get();
        return view('transactionDetail', ['transactionDetails' => $transactionDetails]);
    }

    public function addCart(Request $request, Item $item)
    {

        $validator = Validator::make($request->all(), [
            'dest_number' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $user = auth()->user();

        // Cek apakah pengguna memiliki transaksi yang sedang berjalan
        $transaction = $user->transaction()->where('status', false)->first();

        // Jika tidak ada transaksi yang sedang berjalan, buat transaksi baru
        if (!$transaction) {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total_price' => 0, // Total harga awal 0
                'transaction_time' => null, // Waktu transaksi awalnya null
                'status' => false
            ]);
        }

        // Tambahkan item ke detail transaksi
        $transaction->transactionDetail()->create([
            'item_id' => $item->id,
            'dest_number' => $request->dest_number
        ]);

        
        // Update total_price berdasarkan perhitungan ulang
        $totalPrice = $transaction->transactionDetail->sum(function ($detail) {
            return $detail->item->price;
        });
        
        $transaction->update([
            'total_price' => $totalPrice
        ]);

        

        return back()->with('toast_success', 'Item added to cart');
    }

    public function deleteCart(TransactionDetail $transactionDetail)
    {
    
        $transactionDetail->delete();
        return back()->with('success','Item has been deleted');
    }

    public function indexCart()
    {
        // Ambil data pengguna saat ini
        $user = auth()->user();

        // Ambil transaksi yang sedang berjalan milik pengguna
        $transaction = $user->transaction()->where('status', false)->first();

        $cart = [];
        if($transaction){
            $totalPrice = $transaction->transactionDetail->sum(function ($detail) {
                return $detail->item->price;
            });
            $transaction->update([
                'total_price' => $totalPrice
            ]);
            $cart = $transaction->transactionDetail;
        }
        return view('cart', ['cart' => $cart,'transaction' => $transaction]);
    }

    public function checkout(Transaction $transaction)
    {

        $transaction->update([
            'status' => true,
            'transaction_time' => Carbon::now()
        ]);
        return redirect('/transactionHistory')->with('success','CheckOut succces');
    }

    public function orderNow(Item $item, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'dest_number' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $user = auth()->user();
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'total_price' => $item->price, // Total harga awal 0
            'transaction_time' => Carbon::now(), // Waktu transaksi awalnya null
            'status' => true
        ]);

        $transaction->transactionDetail()->create([
            'item_id' => $item->id,
            'dest_number' => $request->dest_number
        ]);


        return redirect('/transactionHistory')->with('success','Order succces');
    }
}
