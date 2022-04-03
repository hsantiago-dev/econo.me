<template>
    <div id="fundo" class="d-flex flex-shrink-0">
        <div v-if="true" style="width: 578px; background-color: #FAFBFE" class="d-flex align-center">
            <div style="width: 100%;" class="d-flex flex-column">
                <span class="text-center titulo align-self-center" style="color: #282455;">
                    <span style="color: #E94E3B"> E aí, </span>bora 
                </span>
                <span class="text-center titulo align-self-center mt-n6"  style="color: #282455;">dividir? </span>
                <v-text-field
                    solo
                    label="usuario.usuario"
                    prepend-inner-icon="fa-solid fa-at"
                    color="#282455"
                    class="mx-8 mx-md-14 mt-10 rounded-xl"
                    height="80"
                ></v-text-field>
                <v-text-field
                    solo
                    label="senha"
                    prepend-inner-icon="fa-solid fa-lock"
                    color="#282455"
                    class="mx-8 mx-md-14 rounded-xl"
                    height="80"
                ></v-text-field>
                <div class="d-flex flex-column align-center mx-8 mx-md-14 mt-4">
                    <v-btn 
                        color="#282455" 
                        dark 
                        class="rounded-lg" 
                        x-large 
                        block 
                        @click="login"
                    >LOGIN</v-btn>
                    <v-btn color="#F5F8FF" style="color: #282455" class="rounded-lg mt-4" x-large block >CADASTRE-SE</v-btn>
                    <span style='color: #E94E3B; text-decoration: underline;' class="mt-4" >Esqueci minha senha</span>
                </div>
            </div>
        </div>
        <v-img
            src="../assets/imgs/background-login.svg"
        >
            <div style="height: 100%;" class="d-flex justify-end">
                <div 
                    class="radiusLeft align-self-center"
                    style="height: 100%; width: 20px; background-color: #FAFBFE;"
                ></div>
            </div>
        </v-img>
        <card-cadastro v-if="false" />
        <!-- <v-snackbar
            v-model="snackbar"
            :timeout="timeout"
        >
            {{ text }}
        </v-snackbar> -->
    </div>
</template>

<script>
    import CardCadastro from './shared/CardCadastro.vue'

    export default {
        name: 'Login',
        components: { CardCadastro },
        methods: {
            login() {
                this.$router.push('/home').catch(() => {})
            }
        }
    }
</script>

<style scoped>
    /* #fundo {
        height: 100%;
        padding: 0;
        background-color: #fff;
    } */

    #fundo {
        position: absolute;
        top: 0; bottom: 0;
        left: 0; right: 0;
        margin: auto;
        height: 100%;
        background-color: #a2a2a2;
    }

    .blob1 {
        /* position: absolute; */
        width: 536px;
        height: 658px;
        left: 1441.88px;
        top: 1573.11px;

        border: 5px solid rgba(233, 78, 59, 0.5);
        box-sizing: border-box;
        transform: rotate(-156.34deg);
    }

    .img {
        max-width: 100%;
        max-height: 100%;
    }    

    .radiusRight {
        border-radius: 0 20px 20px 0;
    }

    .radiusLeft {
        border-radius: 20px 0 0 20px;
    }

    /* .ocuparHeight {
        height: 100%;
        padding: 0;
    } */
</style>