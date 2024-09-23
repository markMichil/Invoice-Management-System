<!DOCTYPE html>
<html>
    <head>
        <title>Invoice Status Updated</title>
    </head>
    <body>
        <h1>Hello, {{$invoice->customer->name}}</h1>

        <p>Your invoice with ID {{ $invoice->id }} has been updated to "{{ $invoice->delivery_status }}".</p>

        <p>Thank you for your business!</p>
    </body>
</html>
