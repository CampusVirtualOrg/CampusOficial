<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import axios from 'axios';

const localMessages = ref([]);

const fetchMessages = async () => {
  try {
    const response = await axios.get('/api/chat');
    localMessages.value = response.data.messages;
  } catch (error) {
    console.error('Error fetching messages:', error);
  }
};

const fetchIntervalId = setInterval(fetchMessages, 5000);

onMounted(() => {
  fetchMessages();
});

onBeforeUnmount(() => {
  clearInterval(fetchIntervalId);
});
</script>

<template>
  <div>
    <div v-for="message in localMessages" :key="message.id" class="message">
      {{ message.content }}: {{ message.from }}
    </div>
  </div>
</template>

<style scoped>
.message {
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
}
</style>
