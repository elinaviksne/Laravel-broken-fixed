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

    {{-- CSRF meta for Fetch API --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fetch API JS --}}
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const tagInput = document.getElementById('tag-input');
    const tagsList = document.getElementById('tags-list');
    let tags = [];

    tagInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && tagInput.value.trim()) {
            e.preventDefault();
            const tagName = tagInput.value.trim();
            if (!tags.includes(tagName)) {
                tags.push(tagName);
                const li = document.createElement('li');
                li.textContent = tagName + ' ';
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.textContent = 'x';
                btn.addEventListener('click', () => {
                    tagsList.removeChild(li);
                    tags = tags.filter(t => t !== tagName);
                });
                li.appendChild(btn);
                tagsList.appendChild(li);
            }
            tagInput.value = '';
        }
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function () {
        form.querySelectorAll('input[name="tags[]"]').forEach(i => i.remove());
        tags.forEach(tag => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'tags[]';
            input.value = tag;
            form.appendChild(input);
        });
    });
});
</script>
</x-layout>