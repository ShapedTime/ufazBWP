@extends('layouts.app')
@section('current_or_not_home')
    {{"current-nav-link"}}
@endsection
@section('content')
<section id="home_section" data-csrf="{{ @csrf_token() }}" data-category-by-acc="{{ route('categories.index') }}">
    @if(auth()->user()->balances->count() == 0)
        <p>You don't have any payment methods. To add payment method follow this <a href="{{ route('paymentmethods') }}">link.</a></p>
    @else
        @foreach(auth()->user()->balances as $balance)
            <div class="flex-container-col b-t-payment">
                <div class="b-t-header flex-container">
                    <i class="icon-{{ $balance->payment_method->icon }} x7 b-t-method-icon"></i>
                    <div class="b-t-name-blnc flex-container-col">
                        <div class="b-t-name">{{ $balance->name }}</div>
                        <div class="b-t-blnc">Balance: {{ $balance->money }} {{ $balance->currency }}</div>
                    </div>
                    <i class="icon-down-arrow b-t-collapse x2" @click="collapse_btn_clicked({{ $balance->id }})"></i>
                    <button class="add-transaction-modal-open" @click="home_add_transaction_btn({{ $balance->id }})"><i class="icon-plus b-t-add-trnsctn x2"></i></button>
                </div>
                <div class="b-t-body">
                    <table class="b-t-table">
                        <thead>
                            <tr class="b-t-table-header">
                                <th>Category</th>
                                <th>Money</th>
                                <th>Date</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody class="home-trnsctn-table-{{ $balance->id }}">
                            @foreach($balance->transactions->take(10) as $transaction)
                                <tr class="b-t-table-content b-t-table-{{ $transaction->category->accounting->type }}">
                                    <td>{{ $transaction->category->name }}</td>
                                    <td>{{ $transaction->money }} {{ $balance->currency }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $transaction->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
        <div class="modal-custom" id="home_add_transaction_modal">
            <div class="modal-content-custom flex-container-col justify-center align-center">
                <h2 class="modal-title-custom">Add Transaction</h2>
                <form action="{{ route('transactions.store') }}" class="flex-container-col" method="POST">
                    @csrf
                    <div class="input-group-custom flex-container" id="home_add_transaction_accounting_container">
                        <div class="input-group-text-custom">Accounting: </div>
                        <select id="home-add-transaction-accounting">
                            @foreach(\App\Accounting::all() as $accounting)
                                    <option value="{{ $accounting->id }}">{{ $accounting->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group-custom flex-container">
                        <div class="input-group-text-custom">Category: </div>
                        <select name="category_id" id="home_add_transaction_category">
                        </select>
                    </div>
                    <input type="hidden" name="balance_id" value="" id="home_add_transaction_balance">
                    <div class="input-group-custom flex-container">
                        <div class="input-group-text-custom">Money: </div>
                        <input type="text" name="money" id="" class="input-group-input-custom">
                    </div>
                    <div class="input-group-custom flex-container">
                        <div class="input-group-text-custom">Date: </div>
                        <input type="date" name="date" id="">
                    </div>
                    <div class="input-group-custom flex-container">
                        <div class="input-group-text-custom">Comment: </div>
                        <textarea name="comment" id="" cols="30" rows="5" class="input-group-textarea-custom"> </textarea>
                    </div>
                    <button type="submit" class="submit-button-custom">Save</button>
                </form>
            </div>
        </div>
    @endif
</section>
@endsection
