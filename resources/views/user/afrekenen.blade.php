<x-user-layout>
    <div class="container mt-4 border border-primary rounded">
        <div class="row p-3">
            <div class="col-md-6 col-10">
                <h3>Inloggen</h3>
                <form action="{{route("login")}}" method="post" class="row justify-content-center gap-3">
                    @csrf
                    @method("POST")
                    <div class="form-group col-10">
                        <label for="">Email adres</label>
                        <input type="email" name="email" class="form-control">
                        <span class="text-danger">@error("email"){{$message}}@enderror</span>
                    </div>
                    <div class="form-group col-10">
                        <label for="">Wachtwoord</label>
                        <input type="password" name="password" class="form-control">
                        <span class="text-danger">@error("password"){{$message}}@enderror</span>
                    </div>
                    <input type="submit" value="Inloggen" class="btn btn-primary w-50">
                </form>
            </div>
            <div class="col-md-6 col-10">
                <h3>Doorgaan als gast</h3>
                <a href="{{route("payCredentialsView")}}" class="btn btn-info">Doorgaan</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</x-user-layout>
