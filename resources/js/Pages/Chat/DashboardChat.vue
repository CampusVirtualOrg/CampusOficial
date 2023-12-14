<script setup>
import ChatMessages from '@/Components/ChatMessages.vue';
import ChatForm from '@/Components/ChatForm.vue';
import { ref } from 'vue'; // Importe 'ref' para criar reatividade

defineProps({
	user: Object,
	messages: Object
})

// Método para adicionar mensagem à lista de mensagens
const addMessage = (message) => {
	messages.value.push({
		user: user.value,
		text: message
	});
};
</script>

<template>
	<div class="container">
		<div class="panel-heading">Chat do Campus Virtual</div>

		<div class="panel-body">
			<ChatMessages :messages="messages" :user="user"/>
		</div>
		<div class="panel-footer">
			<ChatForm @message-sent="addMessage" :user="user" />
		</div>
	</div>
</template>
  
<style>
.container {
	font-family: 'Inter', sans-serif;
	width: 100%;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	gap: 1rem;
	margin-bottom: 6rem;
}

.panel-body {
	width: 100%;
}

.panel-footer {
	width: 80%;
	position: fixed;
	bottom: 0;
	margin-bottom: 1rem;
}

.panel-heading {
	color: #3065ac;
	font-weight: 800;
	font-size: 24pt;
}
</style>
	