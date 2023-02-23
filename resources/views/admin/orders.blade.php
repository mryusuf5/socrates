<x-admin-layout>
    <div class="container mb-4">
        <h3>Bestellingen</h3>
        @if($message = Session::get("success"))
            <div class="alert alert-success">
                <h3>{{$message}}</h3>
            </div>
        @endif
        <div class="row gap-2 justify-content-center">
            @foreach($orders as $order)
            <div class="col-lg-3 col-10 card">
               <div class="card-body">
                   <h5 class="card-title">{{$order->firstname . " " . $order->prefix . " " . $order->lastname}}</h5>
                   <h6 class="card-subtitle mb-2 text-muted">{{$order->created_at}}</h6>
                   <p class="card-text">{{$order->email}}</p>
                   <p class="card-text">{{$order->phonenumber}}</p>
                   <p class="card-text">{{$order->adress . " " . $order->housenumber}}</p>
                   <p class="card-text">{{$order->postalcode . " " . $order->residence}}</p>
                   <p class="card-text fw-bold">{{$order->name . " " . $order->choiceName . " x" . $order->amount}}</p>
                   <a href="{{route("admin.archiveProduct", $order->id)}}" class="card-link">Archiveren</a>
               </div>
            </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>
