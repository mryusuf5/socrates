<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        .main-container{
            border: 1px solid black;
            padding: 4em;
        }

        header{
            display: flex;
            justify-content: space-between;
            display: -webkit-box;
        }

        header>div {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }

        .table th{
            border-bottom: 1px solid black;
        }

        .table td:not(:last-child){
            border-right: 1px solid black;
        }

        .table td{
            border-bottom: 1px solid black;
        }

        .table{
            width: 75vw;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <img src="https://so-crates.nl/images/socrates2.jpg" style="height: 100px; position: sticky; left: 50%;" alt="">
    <div class="">
        <header class="fs-6">
            <div class="d-flex" style="float: left; width: 25%; height: 300px">
                <h4 class="">Factuur</h4>
                <p>Factuurdatum: {{now()->toDateString()}}</p>
                <p>Factuurnr.: {{$invoiceCode}}</p>
            </div>
            <div class="" style="margin-left: 35%;">
                <h5>Socrates Microdose</h5>
                <p>Lage Witsiebaan 78-36</p>
                <p>5042DB Tilburg</p>
                <p>so-cratesmd@hotmail.com</p>
                <p>06-29 95 77 69</p>
                <p>Kvk nr.: 88807754</p>
                <p>Btw nr.: NL004657382B51</p>
                <p>IBAN: NL49 RABO 0157 9747 31</p>
            </div>
        </header>
        <main>
            <h5>Klantgegevens</h5>
            <p>Naam: {{$user["firstname"] . " " . $user["prefix"] . " " . $user["lastname"]}}</p>
            <p>Email: {{$user["email"]}}</p>
            <p>Tel. nr.: {{$user["phone"]}}</p>
            <br>
            <h5>Afleveradres</h5>
            <p>Adres: {{$user["adress"] . " " . $user["housenumber"]}}</p>
            <p>Postcode: {{$user["postalcode"]}}</p>
            <p>Plaats: {{$user["residence"]}}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Aantal</th>
                        <th scope="col">Artikel</th>
                        <th scope="col">Artikel optie</th>
                        <th scope="col">Omschrijving</th>
                        <th scope="col">Prijs</th>
                        <th scope="col">Totaal</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $order)
                    <tr>
                        <td>{{$order->amount}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->choiceName}}</td>
                        <td>{!! $order->description !!}</td>
                        <td style="text-align: end">&euro;{{$order->choicePrice}}</td>
                        <td style="text-align: end">&euro;{{$order->amount * $order->choicePrice}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </main>
        <footer>
            <div class="totaal border border-dark p-2" style="text-align: right">
                <p>Totaal exlusief BTW: &euro;{{number_format(($totalPrice + 4.15) / 1.21, 2)}}</p>
                <p>Verzendkosten: &euro;4,15</p>
                <p>21,00% BTW: &euro;{{number_format((($totalPrice + 4.15) / 121) * 21, 2)}}</p>
                <br>
                <p>Totaal inclusief BTW: &euro;{{$totalPrice + 4.15}}</p>
            </div>
        </footer>
    </div>
</body>
</html>
