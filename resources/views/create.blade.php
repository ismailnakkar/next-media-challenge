<x-app-layout>
    <div class="container mt-5">
        <div class="card w-75 mx-auto">
            <div class="card-body">
                <form action="{{ route('products.store') }}" class="form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <x-display-status/>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input class="form-control" type="number" step=".01" name="price">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input class="form-control" type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="category">Categories (Optional)</label>
                        <select multiple name="categories[]" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-display-errors/>
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
