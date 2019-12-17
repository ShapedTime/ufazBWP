<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentmethods()
    {
        return view('home.payment_methods');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'payment_method_id' => ['integer'],
            'name' => ['required', 'string', 'max:255'],
            'money' => ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'currency' => ['required', 'string', 'max:4'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'payment_method_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'money' => ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'currency' => ['required', 'string', 'max:4'],
        ]);

//        Balance::create([
//            'user_id' => auth()->user()->id,
//            'payment_method_id' => $data['payment_method_id'],
//            'name' => $data['name'],
//            'money' => $data['money'],
//            'currency' => $data['currency'],
//        ]);
        $balance = Auth::user()->balances()->create($data);
        $curTime = new \DateTime();
        $date = $curTime->format("Y-m-d");
        Auth::user()->transactions()->create([
            'category_id' => 22,
            'balance_id' => $balance->id,
            'money' => $data['money'],
            'date' => $date,
            'comment' => 'Created Payment Method with this much money!',
        ]);
        return redirect('paymentmethods');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    public function destroy($id)
    {
        Balance::destroy($id);
        return redirect('paymentmethods');
    }
}
