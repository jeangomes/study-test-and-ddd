<h1>Purchase Detail</h1>
<table border="1" cellpadding="0" cellspacing="0" width="80%">
    <tr>
        <td>Name</td>
        <td>Code</td>
        <td>Quantity</td>
        <td>Unit measure</td>
        <td>Unit Price</td>
        <td>Total Price</td>
        <td>-</td>
    </tr>
    @foreach($purchase->items as $item)
        <tr>
            <td>{{$item->product_name}}</td>
            <td>{{$item->product_code}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->unit_measure}}</td>
            <td>{{$item->unit_price}}</td>
            <td>{{$item->total_price}}</td>
            <td>-</td>
        </tr>
    @endforeach
</table>

