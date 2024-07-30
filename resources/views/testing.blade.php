<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="" x-data="{show: false}">

        @if(true)
        <i class="fa fa-gear" @click="show = true">test</i>
@else
<i class="fa fa-trash" @click="show = true">test</i>
@endif
        <div class="" x-show="show">Arfan</div>
    </div>
</body>
</html>