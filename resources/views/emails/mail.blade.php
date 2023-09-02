<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email from {{ $data['name'] }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');
        .body{
            background-color: #f0f2ff;
            font-family: 'Raleway', sans-serif;
        }
        .box{
            padding: 5%;
            max-width: 35em;
            margin: 1.5em auto;
            background-color: #fff;
        }
        .btn-mail{
            display: inline-block;
            margin: 1em auto;
            padding: 0.9em 1.2em;
            background-color: #2C67B7;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="body" style="background-color: #f0f2ff;
    font-family: 'Raleway', sans-serif;padding:3em 1em;">
        <div class="box" style="padding: 5%;
        max-width: 35em;
        margin: 1.5em auto;
        background-color: #fff;border-radius:15px;">
            <p><b>Pengirim : </b>{{ $data['name'] }} - {{ $data["email"] }}</p>
            <p><b>No. Hp/Wa : </b>{{ $data['no'] }}</p>
            <p><b>Massages : </b><br>
            {{ $data['messages'] }}
            </p>

            <a class="btn-mail"
            
            style="display: inline-block;
            margin: 1em auto;
            padding: 0.9em 1.2em;
            background-color: #2C67B7;
            color: #fff;
            text-decoration: none;"
            
            href="mailto:{{ $data['email'] }}">Tanggapi Pesan</a>
        </div>
    </div>
</body>
</html>
