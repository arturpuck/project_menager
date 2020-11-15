<template>
  <div  class="relative-shadow-container">
    <slot></slot>
  </div>
</template>

<script lang="ts">
	export default {
        name: 'relative-shadow-container'
    }
</script>

<style lang="scss">

.relative-shadow-container{
    position:absolute;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
    display:flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
    top: 0;
    left: 0;
}

</style>