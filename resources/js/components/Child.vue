<template>
  <transition name="page" mode="out-in">
    <slot>
      <!-- why putting key? see https://bit.ly/3lo5w0t  -->
      <router-view :key="$route.fullPath" />
    </slot>
  </transition>
</template>

<script>
export default {
  name: 'Child'
}
</script>
