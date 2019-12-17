<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExport implements FromView
{
    use Exportable;


    /**
     * @inheritDoc
     */
    public function view(): View
    {
        return view('exports.transactions', [
            'transactions' => auth()->user()->transactions->all(),
        ]);
    }
}
