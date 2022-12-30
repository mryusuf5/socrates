<x-user-layout>
    <br>
    <div class="container">
        <form action="" class="d-flex border border-primary border-1">
            <input type="search" class="form-control">
            <input type="submit" value="Zoek" class="btn btn-primary">
        </form>
        <br>
        <div class="row gap-2 justify-content-center">
            @foreach($products as $product)
                <div class="card col-md-3 col-5">
                    <div style="background-image: url('images/products/{{$product->image}}')" class="card-img-top cardImage mt-3">
                    </div>

                    <div class="card-body">
                        <div class="card-title fw-bold fs-4">{{$product->name}}</div>
                        <p>{{Str::limit($product->description, 45)}}</p>
                        <a href="#" class="btn btn-primary">Toevoegen aan winkelmand</a>
                    </div>
                </div>
            @endforeach
            {{$products->links()}}
        </div>
    </div>
</x-user-layout>
