<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

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
    <h4>Quantity: {{ $product->quantity }}</h4>
    <p>{{ $product->description }}</p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>


    {{-- Tags section --}}
    <h3>Tags</h3>
    <ul id="tags-list">
        @foreach($product->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>

    <form id="add-tag-form">
        @csrf
        <input type="text" name="tag_name" id="tag_name" placeholder="Add new tag">
        <button type="submit">Add Tag</button>
    </form>
</x-layout>