<template>
    <div id="fundo" class="d-flex flex-shrink-0">
        <div v-if="page == 0" style="width: 578px; background-color: #FAFBFE" class="d-flex align-center">
            <div style="width: 100%;" class="d-flex flex-column">
                <span class="text-center titulo align-self-center" style="color: #282455;">
                    <span style="color: #E94E3B"> E aí, </span>bora 
                </span>
                <span class="text-center titulo align-self-center mt-n6"  style="color: #282455;">dividir? </span>
                <v-text-field
                    solo
                    v-model="usuario"
                    label="usuario.usuario"
                    prepend-inner-icon="fa-solid fa-at"
                    color="#282455"
                    class="mx-8 mx-md-14 mt-10 rounded-xl"
                    height="80"
                ></v-text-field>
                <v-text-field
                    solo
                    v-model="senha"
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
                    >
                        LOGIN
                    </v-btn>
                    <v-btn 
                        color="#F5F8FF" 
                        style="color: #282455" 
                        class="rounded-lg mt-4" 
                        x-large 
                        block 
                        @click="irCadastro"
                    >
                        CADASTRE-SE
                    </v-btn>
                    <v-btn
                        text 
                        style='color: #E94E3B; text-decoration: underline;' 
                        class="mt-4 text-none"
                        @click="irEsqueciMinhaSenha"
                    >Esqueci minha senha</v-btn>
                </div>
            </div>
        </div>
        <v-img
            src="../assets/imgs/background-login.svg"
            :width="600"
        >
            <div style="height: 100%;" :class="'d-flex ' + ((page == 0) ? 'justify-start': 'justify-end')">
                <div 
                    v-if="page == 0"
                    class="radiusRight align-self-center"
                    style="height: 100%; width: 20px; background-color: #FAFBFE;"
                ></div>
                <div 
                    v-else
                    class="radiusLeft align-self-center"
                    style="height: 100%; width: 20px; background-color: #FAFBFE;"
                ></div>
            </div>
        </v-img>
        <card-cadastro v-if="page == 1" @voltarLogin='page = 0' />
        <card-esqueci-minha-senha v-else-if="page == 2" />
    </div>
</template>

<script>
    import CardCadastro from './shared/CardCadastro.vue'
    import CardEsqueciMinhaSenha from './shared/CardEsqueciMinhaSenha.vue';
    import axios from '../axios'

    export default {
        name: 'Login',
        data: () => ({
            page: 0, // 0 - Login, 1 - Cadastro de usuário, 2 - Esqueci minha senha
            usuario: '',
            senha: '',
        }),
        components: { CardCadastro, CardEsqueciMinhaSenha },
        methods: {
            async login() {

                let body = {
                    usuario: this.usuario,
                    senha: this.senha
                }

                await axios.post('/login', body)
                .then(res => {

                    this.$emit('exibirMensagem', res.data, 'success');
                    this.$router.push('/home').catch(() => {})
                })
                .catch(err => {

                    this.$emit('exibirMensagem', err.response.data.errMsg);
                })
            },
            
            irCadastro() {
                this.page = 1;
            },
            irEsqueciMinhaSenha() {
                this.page = 2;
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