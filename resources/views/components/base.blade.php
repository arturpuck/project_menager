<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="UTF-8">
    <title>{{__($title)}}</title>
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{__($description)}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;1,200&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df4e1e2dba.js" crossorigin="anonymous"></script>
    {{$styles}}
</head>
<body class="body">
  <div id="app">
   <navbar @if(\Auth::user()->is_ordinary_team_member) v-bind:ordinary-team-member="true" @endif></navbar>
    {{$slot}}
  </div>
  {{$scripts}}
</body>
</html>