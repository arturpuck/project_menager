import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import PositiveButton from '@jscomponents/controls/positive_button.vue';
import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue'
import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
import UserNotification from '@jscomponents/user_notification.vue';
import { createDebuggerStatement } from 'typescript';
import translator from '@js/translator';

Vue.component('positive-button', PositiveButton);
Vue.component('navbar', Navbar);
Vue.component('labeled-select', LabeledSelect);
Vue.component('relative-shadow-container', RelativeShadowContainer);
Vue.component('expect-circle', ExpectCircle);
Vue.component('user-notification', UserNotification);

new Vue({
    el: '#app',
   
    data() {

        return{
            filterProjectId:'',
            filterProjectMenagerId:'',
            filterAccountId:'',
            filterMonth:'',
            projectsProfitabilityIndex:0,
            projectNames: [],
            accountNames: [],
            projectMenagers: [],
            realIncomes: [],
            projectCosts:[],
            projectedIncomes: [],
            currentProfits:[]
        };
    
    },
   
    methods : {

        async getProjectProfitabilityData(){

                const requestData = {
                   method : 'GET',
                   headers : {
                      'X-CSRF-TOKEN' : this.csrfToken,
                      'Content-type': 'application/json; charset=UTF-8'
                   }
                   
                };
                let queryParams:string = '';

                if(this.filterProjectId){
                   queryParams = `project_id=${this.filterProjectId}&`;
                }

                if(this.filterProjectMenagerId){
                    queryParams += `project_menager_id=${this.filterProjectMenagerId}&`;
                 }

                 if(this.filterAccountId){
                    queryParams += `account_id=${this.filterAccountId}&`;
                 }
                
                 queryParams = queryParams.slice(0,-1);

                const response = await fetch(`/projects/get-profitability?${queryParams}`,requestData);
                
                switch(response.status){
                    case 200:
                       const responseBody = await response.json();
                       this.employees = responseBody;
                       console.log(responseBody);
                       this.loadProjectsProfitabilityData(responseBody);
                    break;
                }
       
    },

    loadProjectsProfitabilityData(projects){
        this.resetTable();

        projects.forEach(project => {
              ++this.projectsProfitabilityIndex;
              this.projectNames.push(project.name);
              this.accountNames.push(project.account.full_name);
              this.projectMenagers.push(project.project_menager.full_name);
              this.realIncomes.push(this.countProjectRealIncome(project.payment_stages));
              this.projectCosts.push(this.countProjectCost(project.project_reports));
              this.projectedIncomes.push(this.countProjectProjectedIncome(project.payment_stages));
              this.currentProfits.push(this.countCurrentProfits(this.projectsProfitabilityIndex - 1));
        });
          
    },

    countCurrentProfits(index:number){
          return this.realIncomes[index] - this.projectCosts[index];
    },

    resetTable(){
        this.projectsProfitabilityIndex = 0;
        this.projectNames = [];
        this.accountNames = [];
        this.projectMenagers = [];
        this.realIncomes = [];
        this.projectCosts = [];
        this.projectedIncomes = [];
    },

    countProjectProjectedIncome(paymentStages){
        let totalIncome:number = 0;

        paymentStages.forEach(function(paymentStage){
                totalIncome += paymentStage.ammount;
        });
        return totalIncome;
    },

    countProjectRealIncome(paymentStages){
        let totalIncome:number = 0;

        paymentStages.forEach(function(paymentStage){

            if(paymentStage.payment_status.name == 'paid'){
                totalIncome += paymentStage.ammount;
            }  
        });
        return totalIncome;
    },

    countProjectCost(projectReports){
        let totalCost:number = 0;

        projectReports.forEach(function(projectReport){
            totalCost += (projectReport.time_spent * projectReport.employee.real_rate_per_hour);
        })
        
        return totalCost;
    }

        
   },

   created(){
       this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
   }
   
});