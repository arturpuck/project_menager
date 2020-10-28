<x-base title="{{$title}}" description="{{$description}}">
   <h1 class="main-header">{{__('projects')}}</h1>

   <positive-button v-on:click.native="showProjectForm" class="add-project-button">
      {{__('add_project')}}
   </positive-button>

   <project-form v-on:close="closeProjectForm" v-show="projectFormIsVisible"></project-form>
   
   <x-slot name="scripts">
       <script src="/js/projects.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/projects.css">
   </x-slot>
</x-base>