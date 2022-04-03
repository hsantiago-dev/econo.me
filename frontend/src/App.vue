<template>
  <v-app>
    <router-view></router-view>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  }),
};
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

  #app {
    background-color: #ddd;
    font-family: 'Poppins', sans-serif;
  }

  .titulo {
    font-size: 64px;
    font-weight: bold;
  }

  .titulo2 {
    font-size: 48px;
    font-weight: bold;
  }
</style>
