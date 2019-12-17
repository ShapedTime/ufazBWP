<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Category;
use App\Exports\TransactionsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home');
    }

    public function store(Request $request){
        $data = $request->validate([
            'category_id' => ['required', 'integer'],
            'balance_id' => ['required', 'integer'],
            'money' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'comment' => ['required', 'string'],
            'date' => ''
        ]);

        $balance = Balance::find($data['balance_id']);
        if(Category::find($data['category_id'])->accounting->id == 1){
            $balance->increment('money', $data['money']);
        }else{
            if($balance->money - $data['money'] < 0) return redirect('home');
            $balance->decrement('money', $data['money']);
        }
        Auth::user()->transactions()->create($data);
        return redirect('home');
    }

    public function export(){
        return (new TransactionsExport(Auth::user()->id))->download('transactions.xlsx');
    }
    public function statistics(){
        return view('home.statistics');
    }

    public static function generalStatistics(){
        $dataPointsIncome = array();
        $dataPointsExpense = array();
        $tempArrayIncome = array();
        $tempArrayExpense = array();
        $transactions = Auth::user()->transactions;
        $sumCountIncome = 0;
        $sumCountExpense = 0;
        foreach ($transactions as $transaction){
            if($transaction->category->accounting->id == 1) {
                if (!isset($tempArrayIncome[$transaction->category->name])) {
                    $tempArrayIncome[$transaction->category->name] = 1;
                } else {
                    $tempArrayIncome[$transaction->category->name]++;
                }
                $sumCountIncome++;
            }else{
                if (!isset($tempArrayExpense[$transaction->category->name])) {
                    $tempArrayExpense[$transaction->category->name] = 1;
                } else {
                    $tempArrayExpense[$transaction->category->name]++;
                }
                $sumCountExpense++;
            }
        }
        foreach ($tempArrayIncome as $key => $value){
            array_push($dataPointsIncome, array('label'=>$key, 'y'=>($value/$sumCountIncome)*100));
        }
        foreach ($tempArrayExpense as $key => $value){
            array_push($dataPointsExpense, array('label'=>$key, 'y'=>($value/$sumCountExpense)*100));
        }
        return [$dataPointsIncome, $dataPointsExpense];
    }

    public static function specificStatistics(Request $request){
        $dataPointsIncome = array();
        $dataPointsExpense = array();
        $tempArrayIncome = array();
        $tempArrayExpense = array();
        $balanceId = $request['id'];
        $transactions = Auth::user()->transactions->where('balance_id', $balanceId);
        $sumCountIncome = 0;
        $sumCountExpense = 0;
        foreach ($transactions as $transaction){
            if($transaction->category->accounting->id == 1) {
                if (!isset($tempArrayIncome[$transaction->category->name])) {
                    $tempArrayIncome[$transaction->category->name] = 1;
                } else {
                    $tempArrayIncome[$transaction->category->name]++;
                }
                $sumCountIncome++;
            }else{
                if (!isset($tempArrayExpense[$transaction->category->name])) {
                    $tempArrayExpense[$transaction->category->name] = 1;
                } else {
                    $tempArrayExpense[$transaction->category->name]++;
                }
                $sumCountExpense++;
            }
        }
        foreach ($tempArrayIncome as $key => $value){
            array_push($dataPointsIncome, array('label'=>$key, 'y'=>($value/$sumCountIncome)*100));
        }
        foreach ($tempArrayExpense as $key => $value){
            array_push($dataPointsExpense, array('label'=>$key, 'y'=>($value/$sumCountExpense)*100));
        }
        return [$dataPointsIncome, $dataPointsExpense];
    }
}
