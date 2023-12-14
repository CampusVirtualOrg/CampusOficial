<script setup>

const props = defineProps({
    messages: Object,
    user: Object
})

const formatDateAgo = (datetime) => {
  const currentDate = new Date();
  const postDate = new Date(datetime);
  const timeDifference = currentDate - postDate;
  const seconds = Math.floor(timeDifference / 1000);
  const minutes = Math.floor(seconds / 60);
  const hours = Math.floor(minutes / 60);

  if (hours < 24) {
    if (hours > 0) {
      return `há ${hours} ${hours > 1 ? 'horas' : 'hora'}`;
    } else if (minutes > 0) {
      return `há ${minutes} ${minutes > 1 ? 'minutos' : 'minuto'}`;
    } else if (seconds > 0) {
      return `há ${seconds} ${seconds > 1 ? 'segundos' : 'segundo'}`;
    }
  } else {
    return postDate.toLocaleString('pt-BR', { timeZone: 'America/Sao_Paulo' });
  }
}

</script>

<template>
    <ul class="chat">
        <li class="list" v-for="message in props.messages">
            <div class="chat-body">
                <div class="rigth" v-if="message.user.id === props.user.id">
                    <strong class="primary-font">Você:</strong>
                    <p>{{ message.message }}</p>
                </div>
                <div class="rigth" v-else>
                    <strong class="primary-font">{{ message.user.name }}</strong>
                    <h2>({{ message.user.tipo }}):</h2>
                    <p>{{ message.message }}</p>
                </div>
                <div class="left">
                    {{ formatDateAgo(message.created_at) }}
                </div>
            </div>
        </li>
    </ul>
</template>

<style scoped>
.chat {
    width: 100%;
    margin-left: 3%;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
    background-color: #fff;
    border: 2px solid #dfdfdf;
    border-radius: 8px;
}

.list {
    display: flex;
}

.chat-body {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    width: 100%;
    padding: 1rem 1rem;
    border-bottom: 2px dashed #cccccc;
}

.rigth {
    display: flex;
    justify-content: start;
    align-items: baseline;
    gap: 0.2rem;
}

.left {
    color: #555555;
    font-weight: 600;
    font-size: 10pt;
}

.chat-body strong {
    font-size: 14pt;
    font-weight: 800;
    color: #3065ac;
}

.chat-body h2 {
    font-size: 12pt;
    font-weight: 500;
    color: #555555;
}

.chat-body p {
    font-size: 12pt;
    font-weight: 400;
    color: #252627;
}
</style>

