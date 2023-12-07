<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import HeaderAluno from "@/Components/HeaderAluno.vue";

// Define as propriedades do componente
const props = defineProps({
  post: Object,
  user: Object
});

// Declaração das variáveis reativas
const formData = ref({
  user_id: props.user.id,
  titulo: 'nothing for while...',
  subtitulo: 'nothing for while...',
  descr: '',
  url: 'nothing for while...'
});

// Função para lidar com o envio do formulário
const handleSubmit = async () => {
  try {
    const response = await fetch('/aviso/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData.value)
    });

    const data = await response.json();
    console.log(data);

    
    // Adicione lógica adicional aqui conforme necessário
  } catch (error) {
    console.error('Erro ao enviar dados:', error);
  }
};
</script>

<template>
  <header>
    <HeaderAluno :nome="props.user.name" :imagem="props.user.imagem" />
  </header>
  <section>
    <div class="section-left">
      <form @submit.prevent="handleSubmit">
        <textarea v-model="formData.descr" :placeholder="`Poste alguma coisa ${props.user.name}!`"></textarea>
        <button type="submit" class="buttonCriar">Postar</button>
      </form>

      <!-- <a href="/aviso/create/view" class="buttonCriar"><span style="font-size: 24pt;">+</span>CRIAR POSTAGEM</a> -->
    </div>
    <div class="section-rigth">

      <a :href="'aviso' + '/' + item['id']" class="container-post" v-for="(item, i) in post" :key="i">
        <div class="text">
          <button hidden>{{ item['id'] }}</button>
          <div class="titles">
            <div class="lado1">
              <h1>{{ item.user.name }}</h1>
              <h2>{{ item.user.tipo }}</h2>
            </div>
          </div>
          <p>{{ item["descr"] }}</p>
          <div class="actions">
            <Link class="comment" :href="'aviso' + '/' + item['id']"><i class="bi bi-chat"></i> Comentar</Link>
          </div>
        </div>
      </a>
    </div>
  </section>
  <!-- <h1>{{ item["titulo"] }}</h1>
  <h2>{{ item["subtitulo"] }}</h2>

  <div class="imagem" v-if="item.img != ''">
    <img :src="'assets/img/' + item['url']" alt="img" />
  </div> -->
  
</template>

<style scoped>
header {
  display: flex;
  align-items: center;
  width: 100vw;
  justify-content: space-between;
  position: relative;
  top: 0;
  margin-top: 1rem;
}

section {
  font-family: 'Inter', sans-serif;
  display: grid;
  grid-template-columns: 20% 70%;
  align-items: center;
  gap: 1rem;
  margin-top: 1rem;
  margin: 1rem 2.5rem;
  height: 100%;
}

.section-left {
  align-self: start;
  display: flex;
  align-items: start;
  justify-content: start;
}

form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 1rem;

  margin-top: 1rem;
}

form input {
    width: 100%;
}

form textarea {
  width: 100%;
  height: 6rem;
  background-color: #fff;
  border: 2px solid #dfdfdf;
  border-radius: 8px;
  resize: none;
}

form textarea:focus {
  border: 2px solid #3065ac;
  outline: none;
}

.buttonCriar {
  width: 100%;
  display: flex;
  justify-content: center;
  background-color: #3065ac;
  padding: 0.4rem;

  font-weight: 600;
  font-size: 14pt;
  color: #fff;
  
  border-radius: 15px;
}
.section-left a {
  width: 15rem;
}

.section-rigth {
  margin-top: 1rem;
  min-height: 80vh;
  display: flex;
  flex-direction: column;
  justify-content: start;
  align-items: center;
  gap: 1rem;
}


.container-post {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: start;
  width: 60%;
  height: auto;
  background-color: #fff;
  border: 2px solid #dfdfdf;
  border-radius: 8px;
  padding: 1rem 2rem;
}

.imagem img {
  max-width: 20%;
  margin: 1rem 0rem;
}

.text {
  display: flex;
  flex-direction: column;
  align-items: start;
  text-align: start;
  gap: 0.4rem;
}

.text h1 {
  font-size: 15pt;
  font-weight: 800;
  color: #3065ac;
}

.text h2 {
  font-size: 12pt;
  font-weight: 500;
  color: #555555;
}

.text p {
  font-size: 12pt;
  font-weight: 400;
  color: #252627;
}

.titles {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.2rem;
}

.lado1 {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.4rem;
}

.actions {
  margin-top: 0.4rem;
}
.comment {
  color: #555555;
  font-size: 12pt;
}
</style>
