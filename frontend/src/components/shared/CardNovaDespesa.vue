<template>
    <v-card
        elevation='0'
        class="rounded-lg"
    >
        <div style="min-height: 115px; background-color: #FAFBFE" class="d-flex flex-column justify-space-between align-center">
            <div class="mt-2 ml-2 d-flex align-self-start">
                <v-card width="20" class="rounded-pill" style="height: 20px;" color='primary'></v-card>
                <v-card width="20" class="ml-2 rounded-pill" style="height: 20px;" color='secondary'></v-card>
            </div>
            <span class="titulo4 primary--text mb-4">
                Registre a nova despesa!
            </span>
        </div>
        <div style="min-height: 170px; background-color: #F2F4FA" class="rounded-xl pb-4">
            <v-row no-gutters justify='space-between'>
                <v-col
                    class="mx-4"
                    cols='12'
                    md='4'
                >  
                    <v-card
                        color="secondary"
                        dark
                        class="d-flex flex-column justify-center align-center rounded-xl my-4"
                    >
                        <span class="mt-4">Valor da despesa:</span>
                        <div class="mx-2 mt-4">
                            <text-field-valor-total class="inputValor" v-model="valor_total" />
                        </div>
                    </v-card>
                </v-col>
                <v-col
                    class="mt-4 mx-4"
                    cols='12'
                    md='7'
                >
                    <div class="d-flex flex-column">
                        <v-text-field
                            single-line
                            class="rounded-xl"
                            label="Titulo da despesa aqui!"
                            solo
                            hint='Titulo da despesa aqui!'
                            color="secondary"
                            height="75"
                        ></v-text-field>
                        <v-row no-gutters justify='space-between'>
                            <v-col
                                cols='5'
                            >
                                <v-text-field
                                    single-line
                                    class="rounded-xl"
                                    appeend-icon='fa-solid fa-calendar-day'
                                    label="Vencimento"
                                    v-mask="['##/##/####']"
                                    solo
                                    hint='Vencimento da despesa, se houver.'
                                    color="secondary"
                                    height="75"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols='6'
                            >
                                <v-combobox
                                    :items='tipo_despesas'
                                    item-text='tipo'
                                    class="rounded-xl"
                                    label="Tipo de despesa"
                                    solo
                                    color="secondary"
                                    height="75"
                                ></v-combobox>
                            </v-col>
                        </v-row>
                    </div>
                </v-col>
            </v-row>
            <v-row no-gutters style="background-color: #fff" class="mx-4 rounded-xl" >
                <v-col
                    cols='12'
                    class="py-1 d-flex justify-space-between align-center"
                >
                    <span class="ml-10 medium">Integrantes:</span>
                    <div class="d-flex align-center">
                        <span v-show="valorFaltante != 0" class="red--text mr-10">*Falta atribuir R$ {{ valorFaltante }}</span>
                        <v-checkbox
                            class="mr-10"
                            v-model="dividirIgualmente"
                            label="Dividir igualmente"
                        ></v-checkbox>
                        <AdicionaUsuario @usuarioSelecionado='addUsuario' />
                    </div>
                </v-col>
                <v-col
                    v-for="(usuario, index) in usuarios"
                    :key="index"
                    cols='12'
                >
                    <v-card 
                        :style="'background-color: ' + ((index % 2 == 0) ? '#3B385C' : '#E94E3B') + ';'"
                        dark
                        elevation='0' 
                        class="mx-4 py-4 mb-1 rounded-xl d-flex align-center justify-space-between"
                    >
                        <div class="d-flex align-center">
                            <v-card width="35" class="rounded-pill ml-10" style="height: 35px;" color='#f2f2f2'></v-card>
                            <span class="ml-10">{{ usuario.nome }}</span>
                        </div>
                        <div class="d-flex align-center mr-10">
                            <text-field-valor-rateio 
                                @input="calcularFaltante" 
                                v-model='valores[index]'
                                :disabled="dividirIgualmente"
                            />
                            <v-btn 
                                fab small 
                                elevation='0'
                                color='white'
                                @click="deleteUsuario(index)"
                            >
                                <v-icon size="20" color='error'>fa-solid fa-trash-can</v-icon>
                            </v-btn>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
            <div class="mx-4">
                <v-btn 
                    block 
                    dark 
                    x-large 
                    height="60" 
                    class="mt-6 gradienteBackground rounded-lg"
                >
                    LANÇAR despesa 
                    <v-icon class="ml-10">fa-solid fa-wallet</v-icon>
                </v-btn>
            </div>
        </div>
    </v-card>
</template>

<script>
    import axios from '../../axios';
    import { getToken } from '../../config';
    import AdicionaUsuario from './AdicionaUsuario.vue';
    import TextFieldValorRateio from './TextFieldValorRateio.vue';
    import TextFieldValorTotal from './TextFieldValorTotal.vue';

    export default {
        components: { 
            AdicionaUsuario,
            TextFieldValorTotal, 
            TextFieldValorRateio
        },
        name: 'CardNovaDespesa',
        data: () => ({
            valor_total: 0,
            dividirIgualmente: true,
            usuarios: [],
            tipo_despesas: [],
            valores: [],
            valorFaltante: 0,
        }),
        created() {

            this.getTiposDespesas();
        },
        watch: {
            usuarios: {
                deep: true,
                handler: 'dividirRateio'
            },
            valor_total() {
                if(this.valor_total < 0) {
                    this.valor_total = 0;
                }

                this.dividirRateio();
            },
            dividirIgualmente() {

                this.dividirRateio();
            }
        },
        methods: {

            calcularFaltante() {
                
                let soma = 0;

                this.valores.forEach(valor => {

                    soma += Number(valor);
                })

                this.valorFaltante = this.valor_total - soma;
            },
            dividirRateio() {

                if (this.dividirIgualmente) {

                    let valorTotal = this.valor_total;

                    let valorRateio = valorTotal/this.usuarios.length;

                    for (let i = 0; i < this.usuarios.length; i++) {

                        if (valorTotal < valorRateio)
                            this.valores[i] = Number(valorTotal);
                        else
                            this.valores[i] = Number(valorRateio);

                        valorTotal -= valorRateio;
                    }
                }

                this.calcularFaltante();
            },
            addUsuario(usuario) {
                
                let aux = this.usuarios.findIndex(el => el.id == usuario.id);

                if (aux >= 0)
                    return;

                this.usuarios.push(usuario);
            },
            deleteUsuario(indexUsuario) {

                this.usuarios.splice(indexUsuario, 1);
                this.valores.splice(indexUsuario, 1);
            },
            async getTiposDespesas() {

                await axios.get('/tipo_despesa', getToken())
                .then(res => {
                    this.tipo_despesas = res.data;
                })
                .catch(err => {

                    if (err.response.status == 401) {
                        alert('Erro de autenticação! Por favor, logue novamente.');
                        this.$router.push('/').catch(() => {})
                    }
                })
            },
        }
    }
</script>

<style scoped>

    .cardNovaDespesa {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .v-input {
        font-size: 20px ;
    }

    .inputValor {
        font-size: 40px ;
    }

    .gradienteBackground {
        background: linear-gradient(90deg, rgba(59,56,92,1) 36%, rgba(233,78,59,1) 100%);
    }
</style>