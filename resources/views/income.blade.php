<x-base title="{{$title}}" description="{{$description}}">
    <h1 class="header header-under-navbar">{{__('projects_income')}}</h1>

   <form class="filter-form">
      @csrf
         <labeled-select v-model="filterPaymentStatus" name="payment_status"
            v-bind:displayed-values="{{json_encode($paymentStatuses->pluck('name'),true)}}">
            {{__('status')}} : 
         </labeled-select>
         <labeled-select v-model="filterMonth" name="month"
            v-bind:values="['01','02','03','04','05','06', '07', '08','09', '10', '11', '12']"
            v-bind:displayed-values="{{json_encode($months)}}">
            {{__('month')}} : 
          </labeled-select>
          <labeled-select v-model="filterYear" name="year"
            v-bind:displayed-values="{{json_encode($yearsRange)}}">
            {{__('year')}} : 
          </labeled-select>
         
       <positive-button v-on:click.native="getPayments" class="filter-button">
          {{__('filter')}}
       </positive-button>
   </form>

   <table class="table">
         <thead>
            <th class="table-header">{{__('client')}}</th>
            <th class="table-header">{{__('project')}}</th>
            <th class="table-header">{{__('name')}}</th>
            <th class="table-header">{{__('money_received')}}</th>
            <th class="table-header">{{__('date')}}</th>
            <th class="table-header">{{__('status')}}</th>
         </thead>
         <tbody>
           <tr class="table-row" v-for="index in ammountOfItems">
               <td v-text="clientNames[index]"  class="table-cell"></td>
               <td v-text="projectNames[index]"  class="table-cell"></td>
               <td v-text="paymentNames[index]"  class="table-cell"></td>
               <td v-text="paymentAmmounts[index]"  class="table-cell"></td>
               <td v-text="paymentDates[index]"  class="table-cell"></td>
               <td  class="table-cell">
                    <labeled-select v-on:input="editPaymentStatus(index)" v-model="paymentStatusesIds[index]" name="payment_status"
                    v-bind:values="{{json_encode($paymentStatuses->pluck('id'),true)}}"    
                    v-bind:displayed-values="{{json_encode($paymentStatuses->pluck('name'),true)}}">
                            {{__('status')}} : 
                    </labeled-select>
               </td>
           </tr>
         </tbody>
     </table>

    <x-slot name="scripts">
       <script src="/js/income.js"></script>
   </x-slot>

   <x-slot name="styles">
      <link rel="stylesheet" href="/css/income.css">
   </x-slot>
   <user-notification></user-notification>
</x-base>