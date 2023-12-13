<script setup>
import Message from '@/Components/Message.vue';
import { defineProps } from 'vue';

const { user, messages } = defineProps(['user', 'messages']);
</script>

<template>
  <div class="chat-container">
    <Message />
    <form class="send" action="/chat" method="post">
      <input type="text" name="content" id="content" placeholder="Digite uma mensagem..." />
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<style scoped>
.chat-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.messages {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
  width: 100%;
}

.message {
  margin-bottom: 5px;
  font-size: 14px;
}

.send {
  display: flex;
  flex-direction: column;
  align-items: center;
}

input {
  width: 100%;
  display: block;
}
</style>
