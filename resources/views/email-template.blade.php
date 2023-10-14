<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h3>Hii {{ $body['customer_name']}}, </h3>
    <p>
        Invoice Date - {{ date('d-m-Y', strtotime($body['invoice_date']))}} <br><br>
        Tax Amount - {{ $body['tax_amount']}} <br><br>
        Invoice Amount - {{ $body['net_amount']}} <br><br>
        The File is attatched.<br><br>
        <b>Thank You!<b>
    </p>
</body>
</html>