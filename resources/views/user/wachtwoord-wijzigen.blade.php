<x-user-layout>
    <br>
    <br>
    <div class="container my-5">
        @if($message = Session::get("error"))
            <div class="alert alert-danger">
                <h3>{{$message}}</h3>
            </div>
        @endif
        @if($message = Session::get("success"))
            <div class="alert alert-success">
                <h3>{{$message}}</h3>
            </div>
        @endif
        <form action="" method="post" class="row justify-content-center gap-3">
            @csrf
            @method("POST")
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Nieuwe wachtwoord</label>
                <input type="password" name="password" class="form-control">
                <span class="text-danger">@error("password"){{$message}}@enderror</span>
            </div>
            <div class="form-group col-10 col-md-6 col-lg-4">
                <label for="">Nieuwe wachtwoord herhalen</label>
                <input type="password" name="passwordConfirm" class="form-control">
                <span class="text-danger">@error("passwordConfirm"){{$message}}@enderror</span>
            </div>
            <input type="submit" value="Wijzigen" class="btn btn-primary w-50">
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>
</x-user-layout>
