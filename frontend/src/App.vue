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
    font-size: 60px;
    font-weight: bold;
  }

  .titulo2 {
    font-size: 44px;
    font-weight: bold;
  }

  .titulo3 {
    font-size: 38px;
    font-weight: bold;
  }

  .label {
    font-size: 16px;
    font-weight: bold;
  }

  .medium {
    font-size: 20px;
  }
</style>
