<template>
 <nav class="horizontal-navbar">
       <ul class="links-list">
            <li class="links-list-element logo-list-element">
               <img src="/images/decoration/logo_navbar.svg" alt="" class="company-logo">
           </li>
           <li v-if="!ordinaryTeamMember" class="links-list-element">
               <a v-text="translations['projects']" href="/projects" class="navbar-link"></a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['team']" href="/team" class="navbar-link"></a>
           </li>
           <li v-if="!ordinaryTeamMember" class="links-list-element">
               <a v-text="translations['projects_profitability']" href="/projects/profitability" class="navbar-link"></a>
           </li>
           <li v-if="!ordinaryTeamMember" class="links-list-element">
               <a v-text="translations['income']" href="/projects/income" class="navbar-link"></a>
           </li>
           
           <li v-on:click="logout" class="links-list-element logout-element">
               <form ref="logout_form" action="/logout" method="POST" class="logout-form">
                   <input type="hidden" v-bind:value="csrfToken" name="_token">
                </form>
                <span class="logout-caption" v-text="translations['logout']"></span>
           </li>
       </ul> 
    </nav>
</template>  

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  
@Component
  export default class Navbar extends Vue {

    private translations = translator('navbar');
    private csrfToken:string = '';

    @Prop({
            type: Boolean,
            required: false,
            default : false
    }) readonly ordinaryTeamMember: boolean;

    logout(){
      (<HTMLFormElement>this.$refs.logout_form).submit();
    }

    created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
    }

 
  }
</script>

<style lang="scss">

@import '~sass/fonts';

.links-list{
    list-style-type: none;
    padding: 0;
    margin:0;
    display:flex;
    font-size: 0;
}

.links-list-element{
    display:inline;  
}

.navbar-link{
    text-decoration:none;
    line-height: 3.9vw;
    display: inline-block;
    cursor:pointer;
    @include responsive-font(1.3vw,13px);
    font-family: 'Montserrat', sans-serif;
    font-weight:bold;
    padding: 0 2vw;
    &:hover{
      background:#159797;
    }
    color:#FFFFFF;
}

.horizontal-navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    background:#0FCACA;
}

.logout-form{
    position:absolute;
    top:-9999px;
    left:0;
}

.logout-caption{
    @include responsive-font(1.3vw,12px);
    font-family: 'Montserrat', sans-serif;
    cursor:pointer;
    display: inline-block;
    font-weight:bold;
    color:white;
    line-height: 3vw;
    padding: 0 1vw;
    border: 1px solid #FFFFFF;
    border-radius: 10px;
}

.company-logo{
    height: 2.5vw;
}

.logo-list-element{
    padding: 0.7vw 7vw;
}

.logout-element{
     &:hover{
      background:#159797;
    }
    display: flex;
    align-items: center;
    padding: 0 1vw;
}
  
</style>