<template>
    <div style="background-color: #FAFBFE; min-width: 750px;" class="d-flex flex-grow-1">
        <div v-if="page == 0" style="width: 100%;" class="d-flex flex-column justify-space-between ">
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
                        Seja bem vindo(a)!
                    </span>
                </div>
                <div ref="form" class="d-flex justify-space-around mt-10">
                    <div class="mr-5 flex-grow-1">
                        <span class="label">Nome *</span>
                        <v-text-field
                            solo
                            ref="nome"
                            v-model="nome"
                            :rules="[rules.required]"
                            label="Seu nome aqui"
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                    <div class="flex-grow-1">
                        <span class="label">CPF *</span>
                        <v-text-field
                            solo
                            ref="cpf"
                            v-model="cpf"
                            :rules="[rules.required]"
                            label="Seu CPF aqui"
                            autocomplete="off"
                            type="tel" 
                            v-mask="['###.###.###-##']"
                            :masked='true'
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                </div>
                <div class="d-flex justify-space-around">
                    <div class="mr-5 flex-grow-1">
                        <span class="label">E-mail *</span>
                        <v-text-field
                            solo
                            ref="email"
                            v-model="email"
                            :rules="[rules.required, rules.email]"
                            label="Seu e-mail aqui"
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                    <div class="flex-grow-1">
                        <span class="label">Data de nascimento *</span>
                        <v-text-field
                            solo
                            ref="dataNascimento"
                            v-model="dataNascimento"
                            :rules="[rules.required]"
                            label="DD/MM/YYYY"
                            type="tel" 
                            v-mask="['##/##/####']"
                            :masked='true'
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                </div>
                <div class="d-flex justify-space-around">
                    <div class="mr-5 flex-grow-1">
                        <span class="label">Telefone *</span>
                        <v-text-field
                            solo
                            ref="telefone"
                            v-model="telefone"
                            :rules="[rules.required]"
                            label="(00)0000-0000"
                            type="tel" 
                            v-mask="['(##)#####-####']"
                            :masked='true'
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                    <div class="flex-grow-1">
                        <span class="label">Nome da mãe *</span>
                        <v-text-field
                            solo
                            ref="nomeMae"
                            v-model="nomeMae"
                            :rules="[rules.required]"
                            label="Nome completo da mãe"
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
                        color="#282455" 
                        dark 
                        prepend-icon="fa-solid fa-arrow-right-long"
                        class="rounded-lg" 
                        x-large 
                        block 
                        @click="prosseguirCadastro"
                    >
                        PROSSEGUIR
                        <v-icon size="25" class="ml-4">fa-solid fa-arrow-right-long</v-icon>
                    </v-btn>
                </div>
            </div>
        </div>
        <div v-else style="width: 100%;" class="d-flex flex-column justify-space-between">
            <div class="d-flex flex-column">
                <span class="text-center titulo2 align-self-start mt-10" style="color: #E94E3B;">
                    Quase acabando!
                </span>
                <div ref="form2" style="width: 400px;" class="mt-10 align-self-center">
                    <div>
                        <span class="label">Usuário *</span>
                        <v-text-field
                            solo
                            v-model="usuario"
                            ref="usuario"
                            :rules="[rules.required]"
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
                            ref="senha"
                            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="show1 ? 'text' : 'password'"
                            @click:append="show1 = !show1"
                            v-model="senha"
                            :rules="[rules.required]"
                            label="Sua senha aqui"
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                    <div>
                        <span class="label">Confirmar Senha *</span>
                        <v-text-field
                            solo
                            ref="confirmacaoSenha"
                            :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="show2 ? 'text' : 'password'"
                            @click:append="show2 = !show2"
                            v-model="confirmacaoSenha"
                            :rules="[rules.required, differentPassword]"
                            label="Sua senha novamente aqui"
                            color="#282455"
                            class="rounded-xl mt-2"
                            height="65"
                        ></v-text-field>
                    </div>
                </div>
            </div>
            <div>
                <v-divider class="mx-4"></v-divider>
                <v-row class="d-flex justify-center my-7 mx-8 mx-md-14">
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
    </div>
</template>

<script>
    import { getToken } from '../../config'
    import axios from '../../axios'

    export default {
        name: 'CardCadastro',
        data: () => ({
            page: 0,
            rules: {
                required: value => !!value || 'Requerido.',
                // counter: value => value.length <= 20 || 'Max 20 characters',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'E-mail inválido.'
                }
            },
            nome: null,
            cpf: null,
            email: null,
            dataNascimento: null,
            telefone: null,
            nomeMae: null,
            usuario: null,
            senha: '',
            confirmacaoSenha: '',
            formHasErrors: false,
            show1: false,
            show2: false,
        }),
        computed: {
            form () {
                return {
                    nome: this.nome,
                    cpf: this.cpf,
                    email: this.email,
                    dataNascimento: this.dataNascimento,
                    telefone: this.telefone,
                    nomeMae: this.nomeMae,
                }
            },
            form2 () {
                return {
                    usuario: this.usuario,
                    senha: this.senha,
                    confirmacaoSenha: this.confirmacaoSenha,
                }
            },
        },
        methods: {

            differentPassword(value) {
                return value == this.senha ? true : 'Senhas não conferem.'
            },
            prosseguirCadastro() {
                this.formHasErrors = false

                Object.keys(this.form).forEach(f => {
                    if (!this.form[f]) this.formHasErrors = true

                    this.$refs[f].validate(true)
                })

                if (!this.formHasErrors) {
                    this.proximaPagina();
                } 
            },
            proximaPagina() {
                this.page++;
            },
            voltarPagina() {
                this.page--;
            },
            voltarLogin() {
                this.$emit('voltarLogin');
            },
            async criarConta() {

                let formHasErrors = false

                Object.keys(this.form2).forEach(f => {
                    if (!this.form2[f]) formHasErrors = true

                    this.$refs[f].validate(true)
                })

                if (formHasErrors || this.differentPassword(this.confirmacaoSenha) == 'Senhas não conferem.') 
                    return;

                let body = {
                    nome: this.nome,
                    cpf: this.cpf,
                    email: this.email,
                    // dataNascimento: this.dataNascimento,
                    telefone_celular: this.telefone,
                    nome_mae: this.nomeMae,
                    usuario: this.usuario,
                    senha: this.senha
                }

                console.log(body);

                await axios.post('/usuario', body, getToken())
                .then(() => {

                    this.$root.$children[0].exibirMensagem('Usuário criado com sucesso!', 'success');
                    this.$emit('voltarLogin');
                })
                .catch(err => {

                    this.$root.$children[0].exibirMensagem(err.response.data.errMsg);
                })
                
            }
        }
    }
</script>

<style scoped>
    
</style>