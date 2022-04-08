<template>
    <div style="width: 1033px; background-color: #FAFBFE" class="d-flex">
        <div v-if="page == 0" style="width: 100%;" class="d-flex flex-column justify-space-between">
            <div class="d-flex flex-column mx-4">
                <div class="d-flex align-center ml-n4 mt-8">
                    <v-btn 
                        @click="voltarLogin" 
                        small 
                        fab 
                        outlined 
                        color="#282455"
                    ><v-icon>fa-solid fa-angle-left</v-icon></v-btn>
                    <span class="titulo2 align-self-start ml-4" style="color: #E94E3B;">
                        Recuperar Senha
                    </span>
                </div>
                <span class="medium align-self-start">
                    Que pena que esqueceu sua senha :( <br> Só preencher o formulário abaixo para iniciarmos o processo de recuperação de senha!
                </span>
                <div class="d-flex justify-center mt-10">
                    <div style="min-width: 320px;" class="mr-5 flex-grow-1">
                        <span class="label">Usuário *</span>
                        <v-text-field
                            solo
                            label="Seu @ aqui"
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                    <div style="min-width: 320px;" class="flex-grow-1">
                        <span class="label">E-mail *</span>
                        <v-text-field
                            solo
                            label="Seu e-mail aqui"
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                </div>
            </div>
            <div>
                <v-divider class="mx-4"></v-divider>
                <div class="d-flex justify-center my-10 align-center mx-8 mx-md-14">
                    <v-btn 
                        color="#FDFCFF" 
                        prepend-icon="fa-solid fa-arrow-right-long"
                        class="rounded-lg" 
                        x-large 
                        width="600"
                        @click="proximaPagina"
                    >
                        <strong>RECUPERAR SENHA</strong>
                    </v-btn>
                </div>
            </div>
        </div>
        <div v-else style="width: 100%;" class="d-flex flex-column justify-space-between">
            <div class="d-flex flex-column">
                <span class="titulo2 align-self-start mt-10" style="color: #E94E3B;">
                    Recuperar Senha
                </span>
                <span class="medium align-self-start">
                    Como procedimento de segurança, faremos uma série de perguntas com base em seu cadastro, responda corretamente para redefinir sua senha!
                </span>
                <span class="titulo3 align-self-center mt-14" style="color: #282455;">
                    Qual o nome da sua mãe?
                </span>
                <div class="d-flex justify-center mt-4">
                    <v-radio-group v-model="radioGroup">
                        <v-radio
                            style="background-color: #fff;"
                            class="my-4 py-4 px-6 rounded-xl"
                            v-for="(mae, i) in ['Teresinha Teste da Silva', 'Teresinha Teste da Silva']"
                            :key="i"
                            :value="i"
                            color="#E94E3B"
                        >
                            <template v-slot:label>
                                <div class="d-flex align-center ml-16">
                                    <span class="medium font-weight-bold">{{ mae }}</span>
                                </div>
                            </template>
                        </v-radio>
                    </v-radio-group>
                    <v-radio-group class="ml-8" v-model="radioGroup">
                        <v-radio
                            style="background-color: #fff;"
                            class="my-4 py-4 px-6 rounded-xl"
                            v-for="(mae, i) in ['Teresinha Teste da Silva', 'Teresinha Teste da Silva']"
                            :key="i"
                            :value="i"
                            color="#E94E3B"
                        >
                            <template v-slot:label>
                                <div class="d-flex align-center ml-16">
                                    <span class="medium font-weight-bold">{{ mae }}</span>
                                </div>
                            </template>
                        </v-radio>
                    </v-radio-group>
                </div>
            </div>
            <div class="d-flex justify-center mb-16">
                <v-btn 
                    color="#FDFCFF" 
                    prepend-icon="fa-solid fa-arrow-right-long"
                    class="rounded-lg" 
                    x-large 
                    width="600"
                    @click="voltarPagina"
                >
                    <strong>VALIDAR</strong>
                </v-btn>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CardEsqueciMinhaSenha',
        data: () => ({
            page: 0,
            radioGroup: null,
        }),
        methods: {
            voltarLogin() {
                this.$emit('voltarLogin');
            },
            proximaPagina() {
                this.page++;
            },
            voltarPagina() {
                this.page--;
            }
        }
    }
</script>