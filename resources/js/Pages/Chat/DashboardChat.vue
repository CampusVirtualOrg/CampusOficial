<script>

// export default {
// 	data() {
// 	  return {
// 		messages: [],
// 		newMessage: '',
// 	  };
// 	},
// 	methods: {
// 	  sendMessage() {
// 		// Simule uma mensagem enviada, você deve enviar para um servidor na realidade
// 		const newMessageObj = {
// 		  id: this.messages.length + 1,
// 		  sender: 'Você',
// 		  content: this.newMessage,
// 		};
// 		this.messages.push(newMessageObj);
// 		this.newMessage = '';
// 	  },
// 	},
//   };
</script>

<template>
	<div class="chat-container">
	  <div class="messages">
		<div v-for="message in messages" :key="message.id" class="message">
		  {{ message.sender }}: {{ message.content }}
		</div>
	  </div>
	  <form class="input-container" action="/chat" method="post">
		<input v-model="newMessage" placeholder="Digite uma mensagem..." />
		<button type="submit" @click="sendMessage">Enviar</button>
	  </form>
	</div>
  </template>

  <style scoped>
  .chat-container {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: space-between;
	width: 300px;
  }

  .messages {
	border: 1px solid #ccc;
	padding: 10px;
	max-height: 300px;
	overflow-y: auto;
  }

  .message {
	margin-bottom: 8px;
  }

  .input-container {
	display: flex;
	margin-top: 10px;
  }

  input {
	flex: 1;
	padding: 5px;
  }

  button {
	margin-left: 5px;
	padding: 5px 10px;
  }
  </style>
