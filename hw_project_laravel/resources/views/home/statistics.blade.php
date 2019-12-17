@extends('layouts.app')
@section('current_or_not_statistics')
    {{"current-nav-link"}}
@endsection
@section('content')
<section id="statistics_section" class="flex-container-col" data-gstatisctics-route="{{ route('transactions.gstatistics') }}" data-sstatisctics-route="{{ route('transactions.sstatistics') }}" data-csrf="{{ @csrf_token() }}">
    <select id="PMSelect" @change="changePM">
        <option value="0">General</option>
        @foreach(auth()->user()->balances as $balance)
            <option value="{{ $balance->id }}">{{ $balance->name }}</option>
        @endforeach
    </select>
    <div id="statistics-container-income"></div>
    <div id="statistics-container-expense"></div>
</section>
@endsection
