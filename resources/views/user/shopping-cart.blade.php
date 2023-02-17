<x-user-layout>
    <div class="container">
        <br>
        @if(Session::get("itemCart"))
        <div class="d-flex flex-md-row flex-column gap-2">
            <div class="border border-primary p-3 d-flex flex-column gap-2 rounded">
                @foreach(Session::get("itemCart") as $index => $item)
                    <div class="d-flex gap-2">
                        <a class="" href="{{route("singleItem", 1)}}">
                            <div class="itemCartImage" style="background-image: url('{{asset("images/products/" . "/" . $item["item"]->image)}}')"></div>
                        </a>
                        <div class="d-flex flex-column justify-content-between w-100">
                            <div>
                                <h4>{{$item["item"]->name}}</h4>
                                <h5>{{$item["productOption"][0]->name}}</h5>
                                <p>{!! Str::limit($item["item"]->description, 25) !!}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Aantal: {{$item["amount"]}}</h4>
                                    <h4>Prijs per stuk: &euro;{{$item["productOption"][0]->price}}</h4>
                                </div>
                                <h1>
                                    <form method="post">
                                        @csrf
                                        @method("POST")
                                        <input type="text" name="index" hidden value="{{$index}}">
                                        <button type="submit" style="border: 0; outline: 0; background: transparent">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="border border-primary p-3 justify-content-between d-flex flex-column rounded">
                <h4>Overzicht</h4>
                <div>
                    <p>Producten: &euro;{{number_format($totalPrice, 2)}}</p>
                    <p>Verzendkosten: &euro;4,15</p>
                    <p>Totaal: &euro;{{$totalPrice + 4.15}} </p>
                    <a href="{{route("payViewGet")}}" class="btn btn-primary">Afrekenen</a>
{{--                    @if(Session::get("user"))--}}
{{--                        <form action="{{route("payCredentialsView")}}" method="post">--}}
{{--                            @csrf--}}
{{--                            @method("POST")--}}
{{--                            <input type="text" hidden value="{{$totalPrice + 4.15}}">--}}
{{--                            <button class="btn btn-info" type="submit">Afrekenen</button>--}}
{{--                        </form>--}}
{{--                        <a href="{{route("payCredentialsView")}}" class="btn btn-info">Afrekenen</a>--}}
{{--                    @else--}}
{{--                        <form action="{{route("payView")}}" method="post">--}}
{{--                            @csrf--}}
{{--                            @method("POST")--}}
{{--                            <input type="text" name="price" hidden value="{{$totalPrice + 4.15}}">--}}
{{--                            <button class="btn btn-info" type="submit">Afrekenen</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}

                </div>
            </div>
            @else
                <h3 class="text-danger">Nog geen producten in je winkelwagen.</h3>
                <br>
                <br>
                <br> <br>
                <br>
                <br> <br>
                <br>
                <br>
                <br>
            @endif
        </div>
{{--        @foreach(Session::get("itemCart") as $item)--}}
{{--            <p>{{$item["amount"]}}</p>--}}
{{--        @endforeach--}}
    </div>
    <br>
    <br>
    <br>
    <br>
</x-user-layout>
