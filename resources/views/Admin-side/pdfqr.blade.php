<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>QR code generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row col-md-6">
            <h1>QR Code generate</h1>
          
            <div class="visible-print text-center">
                <h1> Laravel QR Code Generator Example </h1>
                
                 
                {{QrCode::generate($qrCode)}}
            </div>
        </div>
    </div>
</body>
</html>