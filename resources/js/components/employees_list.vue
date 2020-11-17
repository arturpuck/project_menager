<template>
<div class="table-container">
      <relative-shadow-container v-show="fetchingEmployeesInProgress">
         <expect-circle v-bind:label="translations['fetching_employees']"></expect-circle>
      </relative-shadow-container>
      <table class="table">
         <thead>
            <th v-text="translations['full_name']" class="table-header"></th>
            <th v-text="translations['position']" class="table-header"></th>
            <th v-text="translations['rate']" class="table-header"></th>
            <th v-text="translations['technologies_and_skills']" class="table-header"></th>
            <th v-text="translations['note']" class="table-header"></th>
            <th v-text="translations['actions']" class="table-header"></th>
         </thead>
         <tbody>
           <tr class="table-row" v-for="employee in employees">
               <td v-text="employee['full_name']" class="table-cell"></td>
               <td v-text="employee['position']['name']" class="table-cell"></td>
               <td v-text="employee['rate_per_hour']" class="table-cell"></td>
               <td class="table-cell"></td>
               <td v-text="employee['note']" class="table-cell"></td>
               <td class="table-cell">
                   <button v-on:click="showEditForm(employee)" v-text="translations['edit']" class="tiny-button"></button>
               </td>
           </tr>
         </tbody>
     </table>
   </div>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue'
  import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
  
@Component({ components : {
     RelativeShadowContainer, ExpectCircle
 }})

  export default class EmployeesList extends Vue {

    private translations = translator('employees_list');
    private csrfToken:string = '';
    private employees:[] = [];
    private fetchingEmployeesInProgress:boolean = true;

    async getEmployeesList(){

         try{

            const requestData = {
               method : 'GET',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken,
                  'Content-type': 'application/json; charset=UTF-8'
               }
               
            };
            
            const response = await fetch('/team/get-all',requestData);
            
            switch(response.status){
                case 200:
                   const responseBody = await response.json();
                   this.employees = responseBody;
                   console.log(responseBody);
                break;
            }
   
       }
       catch(error){
          alert(error.message);
       }
       finally{
           this.fetchingEmployeesInProgress = false;
       }
    }

    created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
        this.getEmployeesList();
    }

    showEditForm(project){

    }

 
  }
</script>

<style lang="scss">

@import '~sass/fonts';
@import '~sass/components/table';
@import '~sass/components/tiny_button';

</style>