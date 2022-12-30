<x-admin-layout>
    <div class="container">
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
        <form action="{{route("products.update", $product->id)}}" method="POST" class="row gap-2">
            @csrf
            @method("PUT")
            <div class="form-group col-5">
                <label>Naam:</label>
                <input type="text" value="{{$product->name}}" class="form-control" name="name">
            </div>
            <div class="form-group col-5">
                <label>Omschrijving:</label>
                <input type="text" value="{{$product->description}}" class="form-control" name="description">
            </div>
            <input type="submit" class="btn btn-primary col-3" value="Aanpassen">
        </form>
            <br>
        <form action="{{route("products.destroy", $product->id)}}" method="post">
            @csrf
            @method("DELETE")
            <input type="submit" value="Verwijderen" class="btn btn-danger">
        </form>
    </div>
</x-admin-layout>
