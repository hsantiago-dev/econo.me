<template>
    <v-container fluid>
        <h1>HOME PAGE</h1>
        <v-btn block @click="logout">
            LOGOUT
        </v-btn>
    </v-container>
</template>

<script>
    import axios from '../axios'
    import { getToken } from '../config'

    export default {
        name: 'Home',
        methods: {

            async logout() {

                console.log(getToken())
                await axios.post('/logout', {}, getToken())
                .then(() => {
                    this.$router.push('/').catch(() => {})
                })
            }
        }
    }
</script>

<style>

</style>