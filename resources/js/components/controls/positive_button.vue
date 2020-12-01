<template>
   <button v-bind:type="type" class="positive-button">
       <slot></slot>
   </button>
</template>

<script>
	export default {
        name: 'positive-button',

        props : {
             type : {
                 required: false,
                 type : String,
                 default : 'button'
             }
        }
    }
</script>

<style lang="scss">

@import'~sass/fonts';

.positive-button
{
	border: 1px solid #0FCACA;
    border-radius: 10px;
    opacity: 1;
    @include responsive-font(1.5vw, 19px);
    font-family:  Montserrat;
    font-weight:bold;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
    cursor:pointer;
    display: inline-flex;
    align-items: center;
    padding: 0.5vw 1vw;
}
</style>