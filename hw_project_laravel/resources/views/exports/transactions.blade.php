<table>
    <thead>
        <tr>
            <td>Payment Method Name</td>
            <td>Payment Method Type</td>
            <td>Category</td>
            <td>Money</td>
            <td>Date</td>
            <td>Comment</td>
        </tr>
    </thead>
    <tbody>
        @foreach(auth()->user()->transactions as $transaction)
            <tr>
                <td>{{$transaction->balance->name}}</td>
                <td>{{$transaction->balance->payment_method->type}}</td>
                <td>{{$transaction->category->name}}</td>
                <td>{{ ($transaction->category->accounting->id == 1) ? "" : '-' }}{{ $transaction->money }}</td>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->comment }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
