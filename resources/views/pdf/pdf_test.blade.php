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
            border: 1px solid black;
        }
    </style>
</head>
<body>
<img src="https://so-crates.nl/images/socrates2.jpg" style="height: 100px; position: sticky; left: 50%;" alt="">
<div class="">
    <header class="">
        <div style="float: left; width: 25%; height: 300px">
            <h4 class="">Factuur</h4>
            <p>Factuurdatum: </p>
            <p>Factuurnr.: </p>
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
        <div style="float: left; width: 25%; height: 300px">
            <h5>Klantgegevens</h5>
            <p>Naam: </p>
            <p>Email: </p>
            <p>Tel. nr.:</p>
        </div>
        <div class="" style="margin-left: 35%;">
            <h5>Afleveradres</h5>
            <p>Adres:</p>
            <p>Postcode: </p>
            <p>Plaats: </p>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Aantal</th>
                <th scope="col">Artikel</th>
                <th scope="col">Omschrijving</th>
                <th scope="col">Prijs</th>
                <th scope="col">Totaal</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Test product</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing </td>
                    <td>&euro;12,50</td>
                    <td>&euro;12,50</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Test product</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing </td>
                    <td>&euro;12,50</td>
                    <td>&euro;12,50</td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        <div class="totaal border border-dark p-2" style="text-align: right">
            <p>Totaal exlusief BTW: &euro;</p>
            <p>Verzendkosten: &euro;4,15</p>
            <p>21,00% BTW: &euro;</p>
            <br>
            <p>Totaal inclusief BTW: &euro;</p>
        </div>
    </footer>
</div>
</body>
</html>
