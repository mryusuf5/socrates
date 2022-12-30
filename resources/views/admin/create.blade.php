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

        <form action="{{route("products.store")}}" method="post" class="row gap-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-5">
                <label>Naam:</label>
                <input type="text" name="name" placeholder="Naam" class="form-control">
            </div>
            <div class="form-group col-5">
                <label>Voorraad:</label>
                <input type="number" name="amount" placeholder="Voorraad" class="form-control">
            </div>
            <div class="form-group col-5">
                <label>Foto:</label>
                <input type="file" name="image" placeholder="Foto" class="form-control">
            </div>
            <div class="form-group col-5">
                <label>Omschrijving:</label>
                <textarea name="description" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <input type="submit" value="Opslaan" class="btn btn-primary col-3">
        </form>
    </div>
</x-admin-layout>
