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
  <header>
    <HeaderAluno :nome="props.user.name" :imagem="props.user.imagem" />
  </header>
  <section>

    <div class="section-left">
      <form @submit.prevent="handleSubmit">
        <textarea v-model="formData.descr" :placeholder="`Poste alguma coisa ${props.user.name}!`" required></textarea>
        <button type="submit" class="buttonCriar">Postar</button>
      </form>
      <!-- <Link :href="route('professor.index')" title="Campus Virtual" class="logoAsclasse">
      <img src="../../../public/assets/img/portal.png" alt="Campus Virtual" class="logoAsclasseExpanded">
      </Link> -->
    </div>

    <div class="section-rigth">

      <a :href="'aviso' + '/' + item['id']" class="container-post" v-for="(item, i) in post" :key="i">
        <div class="text">
          <button hidden>{{ item['id'] }}</button>
          <div class="titles">
            <h1>{{ item.user.name }}</h1>
            <h2>{{ item.user.tipo }}</h2>
          </div>
          <p>{{ item["descr"] }}</p>
          <div class="actions">
            <Link class="comment" :href="'aviso' + '/' + item['id']" title="Comentar"><i class="bi bi-chat"></i></Link>
            <h2>{{ formatDateAgo(item.created_at) }}</h2>
          </div>
        </div>
      </a>
    </div>
  </section>
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
  height: 60vh;
  align-self: start;
  display: flex;
  flex-direction: column;
  align-items: start;
  justify-content: space-between;
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

.logoAsclasse {
  max-width: 4rem;
}

.section-rigth {
  margin-top: 1rem;
  min-height: 80vh;
  display: flex;
  flex-wrap: wrap;
  justify-content: start;
  align-items: center;
  gap: 1rem;
}


.container-post {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: start;
  min-width: 30%;
  max-width: 40%;
  height: auto;
  background-color: #fff;
  border: 2px solid #dfdfdf;
  border-radius: 8px;
  padding: 1rem 1rem;
}

.text {
  width: 100%;
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
  flex-direction: column;
  align-items: start;
  line-height: 130%;
}

.actions {
  margin-top: 0.4rem;
  width: 100%;
  display: flex;
  justify-content: space-between;
  gap: 0.2rem;
}

.comment {
  color: #555555;
  font-size: 12pt;
  display: flex;
  gap: 0.2rem;
}

.imagem img {
  max-width: 20%;
  margin: 1rem 0rem;
}

@media screen and (max-width: 878px) {
  header {
    gap: 2rem;
  }

  section {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 100%;
  } 

  .section-left {
    height: auto;
    align-self: center;
    width: 100%;
  }

  form {
    gap: 0.2rem;
  }
  .section-rigth {
    margin-top: 0;
    flex-direction: column;
  }

  .container-post {
    min-width: 100%;
    max-width: 100%;
  }


}
</style>
