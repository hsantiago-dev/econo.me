<template>
    <v-container class="cardPage">
        <div
            class="fill-height d-flex"
        >
            <v-row class="mt-4 mx-4" justify='space-between'>
                <v-col
                    cols='12'
                    md='5'
                    class="cardReceber rounded-xl"
                ></v-col>
                <v-col
                    cols='12'
                    md='5'
                    class="cardDevendo rounded-xl"
                ></v-col>
                <v-col 
                    cols='12'
                    class="pb-4"
                >
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-end fill">
                            <v-dialog
                                v-model="dialog"
                                width="1056"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="primary"
                                        large
                                        outlined
                                        class="my-4 px-14"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        Nova despesa
                                    </v-btn>
                                </template>
                                <CardNovaDespesa />
                            </v-dialog>
                        </div>
                        <v-data-table
                            :headers="headers"
                            :items="despesas"
                            :items-per-page="5"
                            class="elevation-1 fill-height"
                        >
                        
                            <template v-slot:[`item.pago`]="{ item }">
                                <div>
                                    <v-icon v-if="item.data_pagamento" color="success">far fa-check-circle</v-icon>
                                    <v-icon v-else color="error">fa-solid fa-circle-xmark</v-icon>
                                </div>
                            </template>
                            <template v-slot:[`item.abrir`]>
                                <v-btn elevation='1' color='#F2F4FA'>
                                    <v-icon color='secondary'>fa-solid fa-money-check</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </div>
                </v-col>
            </v-row>
            <div
                class=" d-flex flex-column align-center"
                style="background-color: #fff; min-width: 300px; border-radius: 60px;"
            >
                <v-img
                    class="rounded-circle my-4 flex-grow-0"
                    width="150"
                    height="150"
                    style="background-color: #f2f2f2;"
                >
                </v-img>
                <v-card
                    outlined 
                    class="font-weight-bold py-1 px-2 rounded-xl"
                >@hsantiago_isso</v-card>
                <v-card
                    class="pa-4 mt-6 rounded-xl d-flex flex-column"
                    style="width: 90%;"
                >
                    <span class="medium font-weight-bold align-self-center">Lista de PIX</span>
                    <div 
                        v-for="index in 4"
                        :key="index"
                        class="d-flex justify-space-between mx-6 mt-4"
                    >
                        <span>(15) 99643-2007</span>
                        <v-icon color="#E94E3B">fa-solid fa-clone</v-icon>
                    </div>
                </v-card>
                <div 
                    class="my-4 rounded-pill"
                    style="min-height: 5px; width: 95%; background-color: #000;"
                ></div>
                <v-card
                    class="pa-4 mb-4 rounded-xl d-flex flex-column flex-grow-1"
                    style="width: 90%;"
                >
                    <span class="medium font-weight-bold align-self-center">Grupos</span>
                </v-card>
            </div>
        </div>
    </v-container>
</template>

<script>
    import axios from '../../axios'
    import { getToken } from '../../config'
    import CardNovaDespesa from '../shared/CardNovaDespesa'

    export default {
        name: 'VisaoGeralDespesasPage',
        components: {
            CardNovaDespesa
        },
        data: () => ({
            dialog: false,
            headers: [
                { text: 'Titulo', value: 'titulo' },
                { text: 'Valor total', value: 'valor_total' },
                { text: 'Data', value: 'data_criacao' },
                { text: 'Valor rateio', value: 'valor' },
                { text: 'Pago?', value: 'pago' },
                { text: 'Visualizar', value: 'abrir' },
            ],
            despesas: [],
        }),
        created() {

            this.getDespesas();
        },
        methods: {

            async getDespesas() {

                await axios.get('/despesa?usuario=' + this.$store.getters.getUserId, getToken())
                .then(res => {
                    this.despesas = res.data;
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

    .cardPage {
        background-color: #FDFCFF;
        height: 100%;
        border-radius: 60px;
    }

    .cardReceber {
        background-color: #3B385C;
        min-width: 300px;
        max-height: 220px;
    }

    .cardDevendo {
        background-color: #E94E3B;
        min-width: 300px;
        max-height: 220px;
    }
</style>