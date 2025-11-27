<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/quantity.js'])

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    

    <h1>{{ $product->name }}</h1>
    <h4>Quantity: <span id="product-quantity">{{ $product->quantity }}</span></h4>
    <p>{{ $product->description }}</p>
    <div class="quantity-buttons">
            <button class="quantity-btn" data-action="increase" data-url="{{ route('products.increase', $product) }}">+ Palielināt</button>
            <button class="quantity-btn" data-action="decrease" data-url="{{ route('products.decrease', $product) }}">− Samazināt</button>
    </div>

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</x-layout>