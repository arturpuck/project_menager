<x-base title="{{$title}}" description="{{$description}}">
   <h1 class="main-header">{{__('projects')}}</h1>
   @if($errors->any())
   <div class="error-information-container">
      <div class="error-header">
         <x-icon-error-cross/>{{__('the_following_errors_occured')}}<x-icon-error-cross/>
      </div>
      <ul class="error-list">
         @foreach($errors->all() as $error)
           <li class="error-list-element">{{$error}}</li>
         @endforeach
      </ul>
   </div>
   @endif

   <positive-button v-on:click.native="showProjectForm" class="add-project-button">
      {{__('add_project')}}
   </positive-button>

   @if(Session::has('succesMessage'))
       <div class="success-message">{{__(Session::get('succesMessage'))}}</div>
   @endif

   <h2 class="header">{{__('projects_list')}}</h2>

   <form class="projects-filter-form">
      @csrf
      <div>
         <labeled-select v-model="filterClientId" name="client_id" 
            v-bind:values="{{json_encode($clients->pluck('id'),true)}}"
            v-bind:displayed-values="{{json_encode($clients->pluck('name'),true)}}">
            {{__('client')}} : 
         </labeled-select>
         <labeled-select v-model="filterTaskId" name="task_id" 
            v-bind:values="{{json_encode($tasks->pluck('id'),true)}}"
            v-bind:displayed-values="{{json_encode($tasks->pluck('name'),true)}}">
            {{__('work_range')}} : 
         </labeled-select>
         <labeled-select v-model="filterStatusId" name="status_id"
            v-bind:values="{{json_encode($projectStatuses->pluck('id'), true)}}"
            v-bind:displayed-values="{{json_encode($projectStatuses->pluck('name'), true)}}">
            {{__('project_status')}} : 
         </labeled-select>
       </div>
       <div>
          <labeled-select v-model="filterMonth" name="month"
            v-bind:values="[1,2,3,4,5,6, 7, 8,9, 10, 11, 12]"
            v-bind:displayed-values="{{json_encode($months)}}">
            {{__('month')}} : 
          </labeled-select>
          <labeled-select v-model="filterYear" name="year"
            v-bind:displayed-values="{{json_encode($yearsRange)}}">
            {{__('year')}} : 
          </labeled-select>
       </div>
       <positive-button v-on:click.native="filterProjects" class="filter-button">
          {{__('filter')}}
       </positive-button>
   </form>
   <div class="projects-table-container">
      <relative-shadow-container v-show="fetchingProjectsInProgress">
         <expect-circle label="{{__('fetching_projects')}}"></expect-circle>
      </relative-shadow-container>
      <table class="projects-table">
         <thead>
            <th class="projects-table-header">{{__('project_name')}}</th>
            <th class="projects-table-header">{{__('client_contact_data')}}</th>
            <th class="projects-table-header">{{__('project_manager')}}</th>
            <th class="projects-table-header">{{__('client')}}</th>
            <th class="projects-table-header">{{__('valuation')}}</th>
            <th class="projects-table-header">{{__('date_finished_at')}}</th>
            <th class="projects-table-header">{{__('project_status')}}</th>
            <th class="projects-table-header">{{__('comments')}}</th>
            <th class="projects-table-header">{{__('actions')}}</th>
         </thead>
         <tbody>
           <tr v-for="project in matchingProjects">
               <td v-text="project['name']" class="projects-table-cell"></td>
               <td v-text="getClientContactData(project)" class="projects-table-cell"></td>
               <td v-text="project['project_manager']['full_name']" class="projects-table-cell"></td>
               <td v-text="project['client']['name']" class="projects-table-cell"></td>
               <td v-text="getProjectValuation(project)" class="projects-table-cell"></td>
               <td v-text="project['finished_at']" class="projects-table-cell"></td>
               <td v-text="project['status']['name']" class="projects-table-cell"></td>
               <td v-text="project['project_comment']" class="projects-table-cell"></td>
               <td class="projects-table-cell">
                   <button v-on:click="showEditForm(project)" class="tiny-button">{{__('edit_project')}}</button>
               </td>
           </tr>
         </tbody>
         
     </table>
   </div>
 
    
   <project-form 
      v-bind:client-ids="{{json_encode($clients->pluck('id'),true)}}"
      v-bind:client-names="{{json_encode($clients->pluck('name'),true)}}"
      v-bind:tasks-names="{{json_encode($tasks->pluck('name'),true)}}"
      v-bind:tasks-ids="{{json_encode($tasks->pluck('id'),true)}}"
      v-bind:employees-names="{{json_encode($employees->pluck('full_name'),true)}}"
      v-bind:employees-ids="{{json_encode($employees->pluck('id'),true)}}"
      v-bind:project-menager-names="{{json_encode($projectMenagers->pluck('full_name'), true)}}"
      v-bind:project-menager-ids="{{json_encode($projectMenagers->pluck('id'), true)}}"
      v-bind:work-range-options="{{json_encode($tasks->pluck('name'), true)}}"
      v-bind:work-range-ids="{{json_encode($tasks->pluck('id'), true)}}"
      v-bind:payment-statuses-ids="{{json_encode($paymentStatuses->pluck('id'), true)}}"
      v-bind:payment-statuses-values="{{json_encode($paymentStatuses->pluck('name'), true)}}"
      v-bind:project-statuses-ids="{{json_encode($projectStatuses->pluck('id'), true)}}"
      v-bind:project-statuses-values="{{json_encode($projectStatuses->pluck('name'), true)}}"
      v-show="projectFormIsVisible"></project-form>
   
   <x-slot name="scripts">
       <script src="/js/projects.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/projects.css">
   </x-slot>
</x-base>