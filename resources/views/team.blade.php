<x-base title="{{$title}}" description="{{$description}}">
    <h1 class="header">{{__('team_members_list')}}</h1>
    <employees-list></employees-list>

    <x-slot name="scripts">
       <script src="/js/team.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/team.css">
   </x-slot>
</x-base>