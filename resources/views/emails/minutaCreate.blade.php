<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minuta</title>
</head>
<body>
    
    <h2>Minuta de tipo {{$minuta['type']}}</h2>

    <p><strong>No: </strong>{{$minuta['id']}} </p>
    <p><strong>Descripcion: </strong>{{$minuta['description']}} </p>
    <p><strong>Participantes Internos: </strong>{{$minuta['participant']}} </p>
    <p><strong>Participantes Externos: </strong>{{$minuta['external_participant']}} </p>
    <p><strong>Estatus: </strong>{{$minuta['status']}} </p>
    
</body>
</html>