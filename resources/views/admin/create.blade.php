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

        <form id="createForm" action="{{route("admin.products.store")}}" method="post" class="row gap-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-lg-5 col-12">
                <label>Naam:</label>
                <input type="text" name="name" placeholder="Naam" class="form-control">
            </div>
            <div class="form-group col-lg-5 col-12">
                <label>Voorraad:</label>
                <input type="number" name="amount" placeholder="Voorraad" class="form-control">
            </div>
{{--            <div class="form-group col-5">--}}
{{--                <label>Prijs:</label>--}}
{{--                <input type="number" step=".01" name="price" placeholder="Prijs" class="form-control">--}}
{{--            </div>--}}
            <div class="form-group col-lg-5 col-12">
                <label>Foto:</label>
                <input type="file" name="image" placeholder="Foto" class="form-control">
            </div>
            <div class="form-group col-lg-5 col-12">
                <label>Omschrijving:</label>
                <textarea id="description" class="form-control" name="description" cols="30" rows="10" style="display: none">
                </textarea>
                <div id="editor" style="height: 200px">
                </div>
            </div>
            <input type="submit" value="Opslaan" class="btn btn-primary col-lg-3 col-12">
        </form>
    </div>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.querySelector('#createForm').addEventListener('submit', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });
    </script>
</x-admin-layout>
