<x-base title="{{$title}}" description="{{$description}}">
    <h1 class="header">{{__('projects_profitability')}}</h1>

   <form class="filter-form">
      @csrf
         <labeled-select v-model="filterProjectId" name="project_id" 
            v-bind:values="{{json_encode($availableProjects->pluck('id'),true)}}"
            v-bind:displayed-values="{{json_encode($availableProjects->pluck('name'),true)}}">
            {{__('project')}} : 
         </labeled-select>
         <labeled-select v-model="filterProjectMenagerId" name="project_menager_id" 
            v-bind:values="{{json_encode($projectMenagers->pluck('id'),true)}}"
            v-bind:displayed-values="{{json_encode($projectMenagers->pluck('full_name'),true)}}">
            {{__('project_menager')}} : 
         </labeled-select>
         <labeled-select v-model="filterAccountId" name="account_id"
            v-bind:values="{{json_encode($accounts->pluck('id'), true)}}"
            v-bind:displayed-values="{{json_encode($accounts->pluck('full_name'), true)}}">
            {{__('account')}} : 
         </labeled-select>
         
       <positive-button v-on:click.native="getProjectProfitabilityData" class="filter-button">
          {{__('filter')}}
       </positive-button>
   </form>

   <table class="table">
         <thead>
            <th class="table-header">{{__('project')}}</th>
            <th class="table-header">{{__('account')}}</th>
            <th class="table-header">{{__('project_menager')}}</th>
            <th class="table-header">{{__('project_income')}}</th>
            <th class="table-header">{{__('project_cost')}}</th>
            <th class="table-header">{{__('operational_profit')}}</th>
         </thead>
         <tbody>
           <tr class="table-row" v-for="index in projectsProfitabilityIndex">
               <td v-text="projectNames[index - 1]" class="table-cell"></td>
               <td v-text="accountNames[index - 1]" class="table-cell"></td>
               <td v-text="projectMenagers[index - 1]" class="table-cell"></td>
               <td v-text="projectIncomes[index - 1]" class="table-cell"></td>
               <td v-text="projectCosts[index -1]" class="table-cell"></td>
               <td v-text="operationalProfits[index -1]" class="table-cell"></td>
           </tr>
         </tbody>
     </table>

    <x-slot name="scripts">
       <script src="/js/profitability.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/profitability.css">
   </x-slot>
</x-base>