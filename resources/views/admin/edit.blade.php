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
        <form id="editForm" action="{{route("admin.products.update", $product->id)}}" method="POST" class="row gap-2" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group col-lg-5 col-12">
                <label>Naam:</label>
                <input type="text" value="{{$product->name}}" class="form-control" name="name">
            </div>
            <div class="form-group col-lg-5 col-12">
                <label>Voorraad:</label>
                <input type="text" value="{{$product->amount}}" class="form-control" name="amount">
            </div>
{{--            <div class="form-group col-5">--}}
{{--                <label>Prijs:</label>--}}
{{--                <input type="text" value="{{$product->price}}" class="form-control" name="price">--}}
{{--            </div>--}}
            <div class="form-group col-5 d-flex flex-column gap-2">
                <label>Foto:</label>
                <img src="{{asset("images/products/") . "/" . $product->image}}" style="width: 250px" alt="">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-check form-switch">
                <input name="comingSoon" class="form-check-input" type="checkbox" id="comingSoon" @if($product->availableCode == 1) checked @endif>
                <label class="form-check-label" for="flexSwitchCheckDefault">Coming soon</label>
            </div>
            <div class="form-check form-switch">
                <input name="soldOut" class="form-check-input" type="checkbox" id="soldOut" @if($product->availableCode == 2) checked @endif>
                <label class="form-check-label" for="flexSwitchCheckDefault">Sold out</label>
            </div>
            <input type="text" name="hiddenImage" value="{{$product->image}}" hidden>
            <div class="form-group col-lg-5 col-12">
                <label>Omschrijving:</label>
                <textarea id="description" class="form-control" name="description" cols="30" rows="10" style="display: none">
                    {{$product->description}}
                </textarea>
                <div id="editor" style="height: 200px">
                    {!! $product->description !!}
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary col-lg-3 col-12" value="Aanpassen">
            </div>
        </form>
            <hr>
            <div class="my-4">
                Creer extra opties voor dit product
                <ul>
                    @foreach($productOptions as $productOption)
                        <form action="{{route("admin.deleteOption", $product->id)}}" method="post">
                            @csrf
                            @method("POST")
                            <input type="text" hidden value="{{$productOption->id}}" name="optionId">
                            <li>{{$productOption->name}} &euro;{{$productOption->price}} <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button></li>
                        </form>
                    @endforeach
                </ul>
                <form action="{{route("admin.createOptions", $product->id)}}" method="post">

                    @csrf
                    @method("POST")
                    <div class="form-group col-lg-5 col-12">
                        <label for="">Naam:</label>
                        <input type="text" name="choiceName" class="form-control">
                    </div>
                    <div class="form-group col-lg-5 col-12">
                        <label for="">Prijs:</label>
                        <input type="number" name="choicePrice" class="form-control" step=".01">
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary" value="Opslaan">
                    </div>
                </form>
            </div>
            <br>
        <hr>
        <div class="mt-4">
            <h4>Meerdere afbeeldingen toevoegen:</h4>
            <div class="d-flex gap-2 flex-wrap">
                @foreach($productImages as $productImage)
                    <div class="d-flex flex-column gap-2">
                        <img style="width: 250px;" src="{{asset("images/products") . "/" . $productImage->image}}" alt="">
                        <form action="{{route("admin.deleteProductImage", $productImage->id)}}" method="post">
                            @csrf
                            @method("POST")
                            <input type="text" value="{{$product->id}}" hidden name="id">
                            <input type="submit" class="btn btn-danger" value="Verwijderen">
                        </form>
                    </div>
                @endforeach
            </div>

            <form action="{{route("admin.multipleImages", $product->id)}}" method="post" class="my-3" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="form-group">
                    <input type="file" name="singleItemImages" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" value="Uploaden">
                </div>
            </form>
            <form action="{{route("admin.products.destroy", $product->id)}}" method="post" class="my-2">
                @csrf
                @method("DELETE")
                <input type="submit" value="Product verwijderen" class="btn btn-danger">
            </form>
        </div>
    </div>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.querySelector('#editForm').addEventListener('submit', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });

    </script>
</x-admin-layout>
