<h1>Listagem de Purchase</h1>
<table border="1" cellpadding="0" cellspacing="0" width="80%">
    <tr>
        <td>ID</td>
        <td>Local</td>
        <td>Data</td>
        <td>Valor Total</td>
        <td>Imposto</td>
        <td>-</td>
        <td>-</td>
    </tr>
    @foreach($purchases as $purchase)
        <tr>
            <td>{{$purchase->id}}</td>
            <td>{{$purchase->store}}</td>
            <td>{{$purchase->purchased_at}}</td>
            <td>{{$purchase->amount}}</td>
            <td>{{$purchase->tax}}</td>
            <td>-</td>
            <td>-</td>
        </tr>
    @endforeach
</table>

