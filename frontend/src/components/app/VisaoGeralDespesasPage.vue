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
                                <div class="d-flex justify-center">
                                    <v-icon v-if="item.data_pagamento" color="secondary">far fa-check-circle</v-icon>
                                    <v-icon v-else color="primary">far fa-dot-circle</v-icon>
                                </div>
                            </template>
                        </v-data-table>
                        <!-- <v-data-iterator
                            :items="despesas"
                            :items-per-page.sync="itemsPerPage"
                            :page.sync="page"
                            :search="search"
                            :sort-by="sortBy.toLowerCase()"
                            :sort-desc="sortDesc"
                            hide-default-footer
                        >
                            <template v-slot:header>
                                <v-toolbar
                                    dark
                                    color="blue darken-3"
                                    class="mb-1"
                                >
                                    <v-text-field
                                        v-model="search"
                                        clearable
                                        flat
                                        solo-inverted
                                        hide-details
                                        prepend-inner-icon="mdi-magnify"
                                        label="Search"
                                    ></v-text-field>
                                    <template v-if="$vuetify.breakpoint.mdAndUp">
                                        <v-spacer></v-spacer>
                                        <v-select
                                            v-model="sortBy"
                                            flat
                                            solo-inverted
                                            hide-details
                                            :items="keys"
                                            prepend-inner-icon="mdi-magnify"
                                            label="Sort by"
                                        ></v-select>
                                        <v-spacer></v-spacer>
                                        <v-btn-toggle
                                            v-model="sortDesc"
                                            mandatory
                                        >
                                        <v-btn
                                            large
                                            depressed
                                            color="blue"
                                            :value="false"
                                        >
                                            <v-icon>mdi-arrow-up</v-icon>
                                        </v-btn>
                                        <v-btn
                                            large
                                            depressed
                                            color="blue"
                                            :value="true"
                                        >
                                            <v-icon>mdi-arrow-down</v-icon>
                                        </v-btn>
                                        </v-btn-toggle>
                                    </template>
                                </v-toolbar>
                            </template>
                            <template v-slot:default="props">
                                <v-row>
                                    <v-col
                                        v-for="item in props.items"
                                        :key="item.name"
                                        cols="12"
                                        sm="6"
                                        md="4"
                                        lg="3"
                                    >
                                        <v-card>
                                        <v-card-title class="subheading font-weight-bold">
                                            {{ item.name }}
                                        </v-card-title>

                                        <v-divider></v-divider>

                                        <v-list dense>
                                            <v-list-item
                                            v-for="(key, index) in filteredKeys"
                                            :key="index"
                                            >
                                            <v-list-item-content :class="{ 'blue--text': sortBy === key }">
                                                {{ key }}:
                                            </v-list-item-content>
                                            <v-list-item-content
                                                class="align-end"
                                                :class="{ 'blue--text': sortBy === key }"
                                            >
                                                {{ item[key.toLowerCase()] }}
                                            </v-list-item-content>
                                            </v-list-item>
                                        </v-list>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </template>
                            <template v-slot:footer>
                                <v-row
                                class="mt-2"
                                align="center"
                                justify="center"
                                >
                                    <span class="grey--text">Items per page</span>
                                    <v-menu offset-y>
                                        <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            dark
                                            text
                                            color="primary"
                                            class="ml-2"
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            {{ itemsPerPage }}
                                            <v-icon>mdi-chevron-down</v-icon>
                                        </v-btn>
                                        </template>
                                        <v-list>
                                        <v-list-item
                                            v-for="(number, index) in itemsPerPageArray"
                                            :key="index"
                                            @click="updateItemsPerPage(number)"
                                        >
                                            <v-list-item-title>{{ number }}</v-list-item-title>
                                        </v-list-item>
                                        </v-list>
                                    </v-menu>

                                    <v-spacer></v-spacer>

                                    <span
                                        class="mr-4
                                        grey--text"
                                    >
                                        Page {{ page }} of {{ numberOfPages }}
                                    </span>
                                    <v-btn
                                        fab
                                        dark
                                        color="blue darken-3"
                                        class="mr-1"
                                        @click="formerPage"
                                    >
                                        <v-icon>mdi-chevron-left</v-icon>
                                    </v-btn>
                                    <v-btn
                                        fab
                                        dark
                                        color="blue darken-3"
                                        class="ml-1"
                                        @click="nextPage"
                                    >
                                        <v-icon>mdi-chevron-right</v-icon>
                                    </v-btn>
                                </v-row>
                            </template>
                        </v-data-iterator> -->
                    </div>
                </v-col>
            </v-row>
            <div
                class=" d-flex flex-column align-center"
                style="background-color: #fff; min-width: 360px; border-radius: 60px;"
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
    import CardNovaDespesa from '../shared/CardNovaDespesa'

    export default {
        name: 'VisaoGeralDespesasPage',
        props: {
            despesas: { type: Array, required: true }
        },
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
                { text: 'Pago', value: 'pago' },
            ],
        })
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