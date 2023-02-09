<x-admin-layout>
    <div class="container">
        @if($message = Session::get("success"))
            <div class="alert alert-success">
                {{$message}}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Instellingen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{Str::limit($product->description, 60)}}</td>
                        <td><a href="{{route("admin.products.edit", $product->id)}}" class="btn btn-primary">Aanpassen</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
</x-admin-layout>

