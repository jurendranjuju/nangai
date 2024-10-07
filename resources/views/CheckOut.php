<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form action="{{ url('payment/create') }}" method="post">
        @csrf
        <button type="submit">Pay with PayPal</button>
    </form>
</body>
</html>
