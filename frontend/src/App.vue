<template>
  <v-app>
    <router-view></router-view>
    <v-snackbar
      top
      :color="corSnackbar"
      v-model="snackbar"
      timeout='3000'
      class="mt-8"
    >
      <div class="pa-2">{{ text }}</div>
    </v-snackbar>
  </v-app>
</template>

<script>

	export default {
		name: 'App',
		data: () => ({
			snackbar: false,
			text: '',
			corSnackbar: 'error',
      widthDisplay: window.innerWidth,
		}),
    computed: {
      displayMobile() {
        return this.widthDisplay <= 1263;
      }
    },
		methods: {
			exibirMensagem(text, cor = 'error') {

        this.text = text;
        this.corSnackbar = cor;
        this.snackbar = true;
      },
		}
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
