<x-user-layout>
    <div class="container mt-4 border border-primary rounded">
        <div class="p-3">
            <form action="{{route("checkout")}}" method="post" class="d-flex gap-2 row justify-content-center">
                @csrf
                @method("POST")
                <div class="form-group col-md-5 col-10">
                    <label for="">Voornaam</label>
                    <input type="text" name="firstname" class="form-control" value="@if(Session::get("user")){{Session::get("user")->name}}@endif">
                    <p class="text-danger">@error("firstname"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Tussenvoegsel</label>
                    <input type="text" name="prefix" class="form-control" value="@if(Session::get("user")){{Session::get("user")->prefix}}@endif">
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Achternaam</label>
                    <input type="text" name="lastname" class="form-control" value="@if(Session::get("user")){{Session::get("user")->lastname}}@endif">
                    <p class="text-danger">@error("lastName"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Email-adres</label>
                    <input type="text" name="email" class="form-control" value="@if(Session::get("user")){{Session::get("user")->email}}@endif">
                    <p class="text-danger">@error("email"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Email-adres herhalen</label>
                    <input type="text" name="confirmEmail" class="form-control" value="">
                    <p class="text-danger">@error("confirmEmail"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Telefoonnummer</label>
                    <input type="number" name="phone" class="form-control">
                    <p class="text-danger">@error("phone"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Land</label>
                    <input type="text" name="" value="Nederland" class="form-control" disabled>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Adres</label>
                    <input type="text" name="adress" class="form-control">
                    <p class="text-danger">@error("adress"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Huisnummer + toevoeging</label>
                    <input type="text" name="housenumber" class="form-control">
                    <p class="text-danger">@error("housenumber"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Postcode</label>
                    <input type="text" name="postalcode" class="form-control">
                    <p class="text-danger">@error("postalcode"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <label for="">Woonplaats</label>
                    <input type="text" name="residence" class="form-control">
                    <p class="text-danger">@error("residence"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-md-5 col-10">
                    <input type="checkbox" class="form-check-input" name="over18">
                    <label class="form-check-label" for="">Ik ben 18+ en ik ga akkoord met de <a href="{{route("algemene-voorwaarden")}}">Algemene voorwaarden.</a></label>
                    <p class="text-danger">@error("over18"){{$message}}@enderror</p>
                </div>
                <div class="form-group col-10">
                    <button type="submit" class="btn btn-primary">Doorgaan naar betaling</button>
                </div>
            </form>
        </div>
    </div>
</x-user-layout>
