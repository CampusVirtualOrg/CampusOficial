<script>
export default {
    props: ['user'],

    data() {
        return {
            newMessage: ''
        }
    },

    methods: {
        sendMessage() {
            const userId = this.user.id; 

            this.$inertia.post('/messages', {
                message: this.newMessage,
                user_id: userId 
            }).then(() => {
                // Limpe o campo após o envio
                this.newMessage = '';
            });
        }

    }
}
</script>

<template>
    <form @submit.prevent="sendMessage">
        <input placeholder="Envie uma mensagem no chat!" type="text" v-model="newMessage">
        <button type="submit">Enviar</button>
    </form>
</template>

<style scoped>
form {
    display: flex;
    width: 100%;
    margin-left: 3%;
    align-items: center;
    justify-content: center;
}

input {
    width: 100%;
    padding: 1rem;
    background-color: #fff;
    border: 2px solid #dfdfdf;
    border-radius: 8px 0px 0px 8px;
}

button {
    background-color: red;
    padding: 1rem;
    border-radius: 0px 8px 8px 0px;
    height: 100%;
    color: #fff;
    font-weight: 500;
    font-size: 14pt;
}
</style>