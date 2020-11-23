<x-base title="{{$title}}" description="{{$description}}">
    <h1 class="header">{{__('team_members_list')}}</h1>
    @if(Session::has('succesMessage'))
       <div class="success-message">{{__(Session::get('succesMessage'))}}</div>
   @endif
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
    <employees-list>
    </employees-list>
    <employee-card
      v-bind:user-roles-values="{{json_encode($roles->pluck('name'), true)}}"
      v-bind:user-roles-ids="{{json_encode($roles->pluck('id'), true)}}"
      v-bind:project-report-statuses-values="{{json_encode($projectReportStatuses->pluck('name'), true)}}"
      v-bind:project-report-statuses-ids="{{json_encode($projectReportStatuses->pluck('id'), true)}}"
      v-bind:employee-positions="{{json_encode($positions->pluck('name'), true)}}"
      v-bind:employee-positions-ids="{{json_encode($positions->pluck('id'), true)}}"
      v-bind:employee-skills="{{json_encode($skills->pluck('name'), true)}}"
      v-bind:employee-skills-ids="{{json_encode($skills->pluck('id'), true)}}"
      v-bind:months="{{json_encode($months)}}"
      @if(\Auth::user()->is_ordinary_team_member)
         v-bind:ordinary-team-member="true"
      @endif
      v-bind:years-range="{{json_encode($yearsRange)}}">
    </employee-card>
    <user-notification></user-notification>

    <x-slot name="scripts">
       <script src="/js/team.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/team.css">
   </x-slot>
</x-base>