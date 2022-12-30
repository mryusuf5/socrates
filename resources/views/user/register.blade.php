<x-user-layout>
    <div class="container my-5">
        <form action="" method="post" class="row justify-content-center gap-3">
            @csrf
            @method("POST")
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Voornaam</label>
                <input type="text" name="name" class="form-control">
                <span class="text-danger">@error("name"){{$message}}@enderror</span>
            </div>
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Tussenvoegsel</label>
                <input type="text" name="prefix" class="form-control">
            </div>
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Achternaam</label>
                <input type="text" name="lastname" class="form-control">
                <span class="text-danger">@error("lastname"){{$message}}@enderror</span>
            </div>
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Email adres</label>
                <input type="email" name="email" class="form-control">
                <span class="text-danger">@error("email"){{$message}}@enderror</span>
            </div>
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Wachtwoord</label>
                <input type="password" name="password" class="form-control">
                <span class="text-danger">@error("password"){{$message}}@enderror</span>
            </div>
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Wachtwoord herhalen</label>
                <input type="password" name="passwordConfirm" class="form-control">
            </div>
            <input type="submit" value="Registreren" class="btn btn-primary w-50">
        </form>
    </div>
</x-user-layout>
