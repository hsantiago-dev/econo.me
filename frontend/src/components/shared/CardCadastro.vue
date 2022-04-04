<template>
    <div style="width: 1033px; background-color: #FAFBFE" class="d-flex">
        <div v-if="page == 0" style="width: 100%;" class="d-flex flex-column">
            <span class="titulo2 align-self-start mt-10" style="color: #E94E3B;">
                Seja bem vindo(a)!
            </span>
            <div class="d-flex justify-center mt-10">
                <div style="min-width: 460px;" class="mr-5">
                    <span class="label">Nome *</span>
                    <v-text-field
                        solo
                        label="Seu nome aqui"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
                <div style="min-width: 460px;">
                    <span class="label">CPF *</span>
                    <v-text-field
                        solo
                        label="Seu CPF aqui"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
            </div>
            <div class="d-flex justify-center">
                <div style="min-width: 460px;" class="mr-5">
                    <span class="label">E-mail *</span>
                    <v-text-field
                        solo
                        label="Seu e-mail aqui"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
                <div style="min-width: 460px;">
                    <span class="label">Data de nascimento *</span>
                    <v-text-field
                        solo
                        label="DD/MM/YYYY"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
            </div>
            <div class="d-flex justify-center">
                <div style="min-width: 460px;" class="mr-5">
                    <span class="label">Telefone *</span>
                    <v-text-field
                        solo
                        label="(00) 00000-0000"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
                <div style="min-width: 460px;">
                    <span class="label">Nome da mãe *</span>
                    <v-text-field
                        solo
                        label="Nome completo da mãe"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
            </div>
            <v-divider class="mx-4"></v-divider>
            <div class="d-flex flex-column align-center mx-8 mx-md-14 mt-4">
                <v-btn 
                    color="#282455" 
                    dark 
                    prepend-icon="fa-solid fa-arrow-right-long"
                    class="rounded-lg" 
                    x-large 
                    block 
                    @click="proximaPagina"
                >
                    PROSSEGUIR
                    <v-icon size="25" class="ml-4">fa-solid fa-arrow-right-long</v-icon>
                </v-btn>
            </div>
        </div>
        <div v-else style="width: 100%;" class="d-flex flex-column">
            <span class="text-center titulo2 align-self-start mt-10" style="color: #E94E3B;">
                Quase acabando!
            </span>
            <div style="width: 460px;" class="mt-10 align-self-center">
                <div>
                    <span class="label">Usuário *</span>
                    <v-text-field
                        solo
                        label="Ex: @usuario.usuario"
                        prepend-inner-icon="fa-solid fa-at"
                        color="#282455"
                        class="mt-2 rounded-xl"
                        height="65"
                    ></v-text-field>
                </div>
                <div>
                    <span class="label">Senha *</span>
                    <v-text-field
                        solo
                        label="Sua senha aqui"
                        prepend-inner-icon="fa-solid fa-lock"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
                <div>
                    <span class="label">Confirmar Senha *</span>
                    <v-text-field
                        solo
                        label="Sua senha novamente aqui"
                        prepend-inner-icon="fa-solid fa-lock"
                        color="#282455"
                        class="rounded-xl mt-2"
                        height="65"
                    ></v-text-field>
                </div>
            </div>
            <v-divider class=""></v-divider>
            <v-row class="d-flex mx-8 mx-md-14 mt-4">
                <v-col cols='4'>
                    <v-btn 
                        color="#FDFCFF" 
                        prepend-icon="fa-solid fa-arrow-right-long"
                        class="rounded-lg" 
                        x-large 
                        block
                        @click="voltarPagina"
                    >
                        <v-icon size="25" class="mr-4">fa-solid fa-arrow-left-long</v-icon>
                        VOLTAR
                    </v-btn>
                </v-col>
                <v-col cols='8'>
                    <v-btn 
                        color="#282455" 
                        dark
                        prepend-icon="fa-solid fa-arrow-right-long"
                        class="rounded-lg" 
                        x-large 
                        block
                        @click="criarConta"
                    >
                        CRIAR CONTA
                        <v-icon size="25" class="ml-4">fa-solid fa-check</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CardCadastro',
        data: () => ({
            page: 0
        }),
        methods: {
            proximaPagina() {
                this.page++;
            },
            voltarPagina() {
                this.page--;
            },
            criarConta() {
                this.$emit('voltarLogin');
            }
        }
    }
</script>

<style scoped>
    
</style>