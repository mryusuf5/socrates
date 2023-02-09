<h1>Nieuwe bestelling van {{$orderInfo["user"]["firstname"] . " " . $orderInfo["user"]["prefix"] . " " . $orderInfo["user"]["lastname"]}}</h1>
<div><h2>Klant gegevens:</h2></div>
<div><h3>Adres:</h3>{{$orderInfo["user"]["adress"] . " " . $orderInfo["user"]["housenumber"]}}</div>
<div><h3>Postcode en woonplaats:</h3>{{$orderInfo["user"]["postalcode"] . " " . $orderInfo["user"]["residence"]}}</div>
<div><h3>Email:</h3>{{$orderInfo["user"]["email"]}}</div>
<div><h3>Tel. nummer:</h3>{{$orderInfo["user"]["phone"]}}</div>
<hr>
<h2>Bestelde producten</h2>
<ul>
    @foreach($orderInfo["products"] as $products)
    <li>{{$products->amount}}x {{$products->name}} &euro;{{$products->amount * $products->price}}</li>
    @endforeach
</ul>
<hr>
<div><h3>Totaal betaald:</h3> &euro;{{$orderInfo["totalPrice"] + 4.15}}</div>
<div><h3>Factuur nummer:</h3>{{$orderInfo["invoiceCode"]}}</div>
