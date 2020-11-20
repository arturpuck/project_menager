<template>
 <nav class="horizontal-navbar">
       <ul class="links-list">
           <li class="links-list-element">
               <a v-text="translations['projects']" href="/projects" class="navbar-link">
                  
               </a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['team']" href="/team" class="navbar-link">
                  
               </a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['payouts']" href="/payouts" class="navbar-link">
                  
               </a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['income']" href="/income" class="navbar-link">
                  
               </a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['cashflow']" href="/cashflow" class="navbar-link">
                  
               </a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['gantt']" href="/gantt" class="navbar-link">
                  
               </a>
           </li>
           <li class="links-list-element">
               <a v-text="translations['uploader']" href="/uploader" class="navbar-link">
                  
               </a>
           </li>
           <li v-on:click="logout" class="links-list-element navbar-option-logout">
               <form ref="logout_form" action="/logout" method="POST" class="logout-form">
                   <input type="hidden" v-bind:value="csrfToken" name="_token">
                </form>
                <span v-text="translations['logout']"></span>
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
}

.links-list-element{
    display:inline;
    @include responsive-font(1.3vw,12px);
    display: inline-block;
}

.navbar-link{
    text-decoration:none;
    padding:7px;
    display: inline-block;
    cursor:pointer;
    @include responsive-font(1.3vw,12px);
    color:white;
    &:hover{
        background:crimson;
    }
}

.horizontal-navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    background:black;
}

.logout-form{
    position:absolute;
    top:-9999px;
    left:0;
}

.navbar-option-logout{
    @include responsive-font(1.3vw,12px);
    cursor:pointer;
    display: inline-block;
    padding: 7px;
    color:white;
    &:hover{
        background:crimson;
    }
}
  
</style>