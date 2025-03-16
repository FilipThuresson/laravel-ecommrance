<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <div>

        <div class="w-full flex justify-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create new product</a>
        </div>

        <table class="table mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Article number</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Active</th>
                    <th>Last updated</th>
                    <th>First created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->article_no }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price_in_cents / 100, 2)}}</td>
                        @if($product->active)
                            <td class="text-success text-lg"><i class="iconoir-check"></i></td>
                        @else
                            <td class="text-error text-lg"><i class="iconoir-xmark"></i></td>
                        @endif
                        <td>{{ $product->updated_at }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td class="flex justify-center gap-1 items-center text-lg">
                            <a href="{{ route('products.show', $product->id) }}" title="view product" class="text-primary"><i class="iconoir-eye"></i></a>
                            @if($user->can('edit products'))
                                <a href="{{ route('products.edit', $product->id) }}" title="edit product"><i class="iconoir-edit-pencil"></i></a>
                            @endif
                            @if($user->can('delete products'))
                                <a title="delete product" class="text-error" onclick="product_{{$product->id}}_delete.showModal()"><i class="iconoir-trash"></i></a>
                                <dialog id="product_{{$product->id}}_delete" class="modal">
                                    <div class="modal-box">
                                        <h3 class="text-lg font-bold text-error">Deleting product</h3>
                                        <div class="divider"></div>
                                        <p class="py-4">You are about to delete product: {{$product->id}} ({{$product->name}})</p>
                                        <span class="flex justify-between items-center">
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error">Delete</button>
                                        </form>
                                        <form method="dialog">
                                            <button class="btn btn-base-200 border-error border">Cancel</button>
                                        </form>
                                    </span>
                                    </div>
                                    <form method="dialog" class="modal-backdrop">
                                        <button>close</button>
                                    </form>
                                </dialog>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</x-app-layout>
