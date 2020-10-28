<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description}}">
    {{$styles}}
</head>
<body class="body">
  <div id="app">
   <navbar></navbar>
    {{$slot}}
  </div>
  {{$scripts}}
</body>
</html>