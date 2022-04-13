<template>
    <v-app>
        <v-navigation-drawer
            v-model="sidemenu"
            color="#F2F4FA"
            width='250'
            app
        >
            <v-list
                style="height: 100%"
                class="d-flex flex-column justify-space-between"
                rounded
                nav
            >  
                <div class="d-flex flex-column">
                    <v-img
                        class="align-self-center mb-4"
                        :width="170"
                        src="../assets/logo.svg"
                    >
                    </v-img>
                    <v-list-item 
                        v-for="page in pages"
                        :key="page.icon"
                        style="max-height: 65px"
                        :to="page.route"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon size="30">{{ page.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="align-self-center mt-2 item-menu">
                            {{ page.titulo }}
                        </v-list-item-title>
                    </v-list-item>
                </div>
                <v-list-item
                    style="max-height: 65px"
                    @click="logout"
                    link
                >
                    <v-list-item-icon>
                        <v-icon size="30">fa-solid fa-arrow-right-from-bracket</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="align-self-center item-menu">
                        SAIR
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-main>
            <div class="d-flex mt-10 align-center flex-column">
                <h1 class="mb-6">Despesas:</h1>
                <v-card
                    width="300"
                    class="ma-5"
                    v-for="(despesa, index) in despesas"
                    :key="index"
                >
                    <v-card-title> {{index+1}} - {{despesa}}</v-card-title>
                </v-card>
            </div>
        </v-main>
    </v-app>
</template>

<script>
    import axios from '../axios'
    import { getToken } from '../config'

    export default {
        name: 'Home',
        data: () => ({
            sidemenu: true,
            pages: [
                {
                    titulo: 'Início',
                    icon: 'fa-solid fa-house'
                },
                {
                    titulo: 'Indicadores',
                    icon: 'fa-solid fa-chart-simple'
                },
                {
                    titulo: 'Gerenciar',
                    icon: 'fa-solid fa-gear'
                },
            ],
            despesas: [],
        }),
        created() {
            this.getDespesas();
        },
        methods: {

            async getDespesas() {

                await axios.get('/despesa', getToken())
                .then(res => {
                    this.despesas = res.data.despesas;
                })
                .catch(err => {

                    if (err.response.status == 401) {
                        alert('Erro de autenticação! Por favor, logue novamente.');
                        this.$router.push('/').catch(() => {})
                    }
                })
            },
            async logout() {

                await axios.post('/logout', {}, getToken())
                .finally(() => {
                    this.deleteAllCookies();
                    this.$router.push('/').catch(() => {})
                })
            },
            deleteAllCookies() {
                let cookies = document.cookie.split(";");

                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i];
                    let eqPos = cookie.indexOf("=");
                    let name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                }
            }
        }
    }
</script>

<style scoped>
    .item-menu {
        font-size: 22px;
        font-weight: bold;
    }
</style>