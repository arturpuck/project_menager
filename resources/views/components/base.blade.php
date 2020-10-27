<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description}}">
    <link rel="stylesheet" href="/css/projects.css">
    <title>{{$title}}</title>
</head>
<body>
    <nav class="horizontal-navbar">
       <ul class="links-list">
           <li class="links-list-element">
               <a href="{{route('projects')}}" class="navbar-link">
                  {{__('projects')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('team')}}" class="navbar-link">
                  {{__('team')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('payouts')}}" class="navbar-link">
                  {{__('payouts')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('income')}}" class="navbar-link">
                  {{__('income')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('cashflow')}}" class="navbar-link">
                  {{__('cashflow')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('gantt')}}" class="navbar-link">
                  {{__('gantt')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('uploader')}}" class="navbar-link">
                  {{__('uploader')}}
               </a>
           </li>
           <li class="links-list-element">
               <a href="{{route('auth.logout')}}" class="navbar-link">
                  {{__('logout')}}
               </a>
           </li>
       </ul> 
    </nav>

    {{$slot}}
    
</body>
</html>