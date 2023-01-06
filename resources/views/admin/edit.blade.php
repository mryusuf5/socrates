<x-admin-layout>
    <div class="container">
        @if($message = Session::get("success"))
            <div class="alert alert-success">
                <h3>{{$message}}</h3>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Vul alles in a.u.b.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route("products.update", $product->id)}}" method="POST" class="row gap-2" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group col-5">
                <label>Naam:</label>
                <input type="text" value="{{$product->name}}" class="form-control" name="name">
            </div>
            <div class="form-group col-5">
                <label>Voorraad:</label>
                <input type="text" value="{{$product->amount}}" class="form-control" name="amount">
            </div>
            <div class="form-group col-5">
                <label>Prijs:</label>
                <input type="text" value="{{$product->price}}" class="form-control" name="price">
            </div>
            <div class="form-group col-5 d-flex flex-column gap-2">
                <label>Foto:</label>
                <img src="{{asset("images/products/") . "/" . $product->image}}" style="width: 250px" alt="">
                <input type="file" name="image" class="form-control">
            </div>
            <input type="text" name="hiddenImage" value="{{$product->image}}" hidden>
            <div class="form-group col-5">
                <label>Omschrijving:</label>
                <textarea class="form-control" name="description" cols="30" rows="10">
                    {{$product->description}}
                </textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary col-3" value="Aanpassen">
            </div>
        </form>
            <br>
        <form action="{{route("products.destroy", $product->id)}}" method="post">
            @csrf
            @method("DELETE")
            <input type="submit" value="Verwijderen" class="btn btn-danger">
        </form>
        <hr>
        <div class="mt-4">
            <h4>Meerdere afbeeldingen toevoegen:</h4>
            <div class="d-flex gap-2 flex-wrap">
                @foreach($productImages as $productImage)
                    <div class="d-flex flex-column gap-2">
                        <img style="width: 250px;" src="{{asset("images/products") . "/" . $productImage->image}}" alt="">
                        <form action="{{route("deleteProductImage", $productImage->id)}}" method="post">
                            @csrf
                            @method("POST")
                            <input type="text" value="{{$product->id}}" hidden name="id">
                            <input type="submit" class="btn btn-danger" value="Verwijderen">
                        </form>
                    </div>
                @endforeach
            </div>

            <form action="{{route("multipleImages", $product->id)}}" method="post" class="my-3" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="form-group">
                    <input type="file" name="singleItemImages" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" value="Uploaden">
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
