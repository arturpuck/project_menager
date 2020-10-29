<x-base title="{{$title}}" description="{{$description}}">
   <h1 class="main-header">{{__('projects')}}</h1>

   <positive-button v-on:click.native="showProjectForm" class="add-project-button">
      {{__('add_project')}}
   </positive-button>

   <project-form 
      v-bind:client-ids="{{json_encode($clients->pluck('id'),true)}}" 
      v-bind:client-names="{{json_encode($clients->pluck('company_name'),true)}}"
      v-bind:project-menager-names="{{json_encode($projectMenagers->pluck('full_name'), true)}}"
      v-bind:project-menager-ids="{{json_encode($projectMenagers->pluck('id'), true)}}"
      v-bind:work-range-options="{{json_encode($tasks->pluck('name'), true)}}"
      v-bind:work-range-ids="{{json_encode($tasks->pluck('id'), true)}}"
      v-on:close="closeProjectForm"
      v-show="projectFormIsVisible"></project-form>
   
   <x-slot name="scripts">
       <script src="/js/projects.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/projects.css">
   </x-slot>
</x-base>