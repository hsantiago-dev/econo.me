<template>
    <div style="width: 1033px; background-color: #FAFBFE" class="d-flex">
        <div style="width: 100%;" class="d-flex flex-column">
            <span class="text-center titulo2 align-self-start mt-10" style="color: #E94E3B;">
                Seja bem vindo(a)!
            </span>
            <div class="d-flex mt-10">
                <div style="min-width: 480px;">
                    <v-text-field
                        solo
                        label="usuario.usuario"
                        prepend-inner-icon="fa-solid fa-at"
                        color="#282455"
                        class="rounded-xl"
                        height="80"
                    ></v-text-field>
                </div>
                <div style="min-width: 480px;">
                    <v-text-field
                        solo
                        label="senha"
                        prepend-inner-icon="fa-solid fa-lock"
                        color="#282455"
                        class="rounded-xl"
                        height="80"
                    ></v-text-field>
                </div>
            </div>
            <div class="d-flex flex-column align-center mx-8 mx-md-14 mt-4">
                <v-btn 
                    color="#282455" 
                    dark 
                    class="rounded-lg" 
                    x-large 
                    block 
                    @click="login"
                >LOGIN</v-btn>
                <v-btn color="#F5F8FF" style="color: #282455" class="rounded-lg mt-4" x-large block >CADASTRE-SE</v-btn>
                <span style='color: #E94E3B; text-decoration: underline;' class="mt-4" >Esqueci minha senha</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CardCadastro',
    }
</script>

<style>

</style>