<!DOCTYPE html>
<html>
<head>
    <title>Your Wishlist</title>
</head>
<body>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h1>Your Wishlist</h1>
    <ul>
        @foreach($wishlistItems as $item)
            <li>
                <strong>{{ $item->name }}</strong> - ${{ $item->price }}
                <br>
                <form action="/wishlist/remove" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                    <button type="submit">Remove from Wishlist</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
