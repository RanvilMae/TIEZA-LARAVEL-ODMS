<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>QR code generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br><br><br> <center>

    <p style="font-size: 130px; font-family: Arial;">
        <strong>
            {{$newid}}
        </strong>
    </p>
    </center>
<div>
    <strong style="font-size: 130px; font-family: Arial; transform: rotate(90deg); float: right; position: relative;left: 90px; top: 160px;">
            ODMS
        </strong>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <img src="data:image/png;base64, {!! base64_encode(QrCode::size(500)->generate($qrCode)) !!} " style="">
    
    
</div>
        
</body>
</html>