<x-user-layout>
{{--    {{dd(Session::get("itemCart"))}}--}}
    <div class="container">
        <br>
        @if(count(Session::get("itemCart")) != 0)
        <div class="d-flex flex-md-row flex-column gap-2">
            <div class="border border-primary p-3 d-flex flex-column gap-2">
                @foreach(Session::get("itemCart") as $index => $item)
                    <div class="d-flex gap-2">
                        <a class="" href="{{route("singleItem", 1)}}">
                            <div class="itemCartImage" style="background-image: url('{{asset("images/products/" . "/" . $item["item"]->image)}}')"></div>
                        </a>
                        <div class="d-flex flex-column justify-content-between w-100">
                            <div>
                                <h4>{{$item["item"]->name}}</h4>
                                <p>{{Str::limit($item["item"]->description, 100)}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Aantal: {{$item["amount"]}}</h4>
                                    <h4>Prijs per stuk: &euro;{{$item["item"]->price}}</h4>
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
            <div class="border border-primary p-3 justify-content-between d-flex flex-column">
                <h4>Overzicht</h4>
                <div>
                    <p>Totaal: &euro;{{$totalPrice}} </p>
                    <a href="{{route("payView")}}" class="btn btn-info">Afrekenen met IDEAL</a>
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
