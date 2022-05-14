<template>
    <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :max-width="500"
        :min-width="300"
        rounded="b-xl"
        :nudge-left='200'
        :nudge-bottom='50'
        transition="slide-y-transition"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn 
                fab
                small
                v-bind="attrs"
                v-on="on"
                color="secondary"
                class="mr-10"
            >
                <v-icon size="20" color='white'>fa-solid fa-plus</v-icon>
            </v-btn>
        </template>

        <v-card>
            <div class="d-flex justify-center">
                <div style="width: 70%;">
                    <v-text-field
                        v-model='pesquisa'
                        label="Buscar"
                        color='indigo'
                        prepend-icon="mdi mdi-magnify"
                        autocomplete="off"
                    ></v-text-field>
                </div>
            </div>
            <v-divider></v-divider>
            <v-responsive
                class="overflow-y-auto"
                max-height="260"
            >   
                <v-list>
                    <v-list-item
                        v-for="(usuario, index) in lista"
                        :key="usuario.id"
                        @click="selecionar(usuario)"
                    >
                        <v-list-item-avatar style="color: white;" size="50" :color="((index % 2 == 0) ? '#3B385C' : '#E94E3B')">
                            {{ gerarAvatar(usuario.nome) }}
                        </v-list-item-avatar>

                        <v-list-item-content class="ml-1">
                            <v-list-item-title> {{ usuario.nome }} </v-list-item-title>
                            <v-list-item-subtitle class="ml-2"> @{{ usuario.usuario }} </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-responsive>
            <v-divider></v-divider>
        </v-card>
    </v-menu>
</template>

<script>
    import axios from '../../axios'
    import { getToken } from '../../config'

    export default {
        name: 'AdicionaUsuario',
        data: () => ({
            menu: false,
            pesquisa: '',
            usuarios: [],
        }),
        created() {

            this.getUsuarios();
        },
        computed: {

            lista() {

                return this.usuarios.filter(e => e.nome.toUpperCase().includes(this.pesquisa.toUpperCase()));
            },
        },
        methods: {

            selecionar(usuario) {
                
                this.menu = false;
                this.pesquisa = '';
                this.$emit('usuarioSelecionado', usuario);
            },
            gerarAvatar(str) {

                let matches = str.split(/\s/).reduce((response,word)=> response+=word.slice(0,1),''); 
                matches = [ 
                    matches[0], 
                    matches[1], 
                    matches[2]
                ]
                let acronym = matches.join('');

                return acronym;
            },
            async getUsuarios() {

                await axios.get('/usuario', getToken())
                .then(res => {
                    this.usuarios = res.data;
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

<style>

</style>