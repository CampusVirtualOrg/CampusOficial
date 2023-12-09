<script setup>
import { Head, Link } from "@inertiajs/vue3";
import HeaderAluno from "@/Components/HeaderAluno.vue";

defineProps({
  authUser: Object,
  userId: Object,
  alunos: Object,
  turma: String,
  turmaObject: Object,
  userCurrent: Object
});
</script>

<template>
  <Head title="Turmas Professor" />
  <header>
    <HeaderAluno :nome="authUser.name" />
  </header>

  <section>
    <main>
      <h1>Aluno: {{ userCurrent.name }}</h1>
      <h2>Turma: {{ turmaObject.nome }}</h2>
      <h2>Disciplina: {{ turmaObject.disciplina.nome }}</h2>
      <form :action="'/professor/turmas/editar/' + userId" method="post">
        <div class="inputs">

          <input type="number" placeholder="Faltas" name="faltas" :value="alunos.faltas" />

          <input type="number" step="any" placeholder="Nota 1° unidade" name="nu1" :value="alunos.nota_unidade1" />

          <input type="number" step="any" placeholder="Nota 2° unidade" name="nu2" :value="alunos.nota_unidade2" />
          <input hidden name="turma_id" :value="turma.turma_id" />

          <span class="text-green-800">{{ alunos.media_final }}</span>

          <span class="text-red-800">{{ alunos.media_final }}</span>

          <button type="submit">Lançar</button>
        </div>
        <Link :href="`/professor/turmas`" class="voltarbtn">Voltar para Minhas Turmas</Link>
      </form>
    </main>
  </section>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");

header {
  display: flex;
  align-items: center;
  width: 100vw;
  justify-content: space-between;
  position: relative;
  top: 0;
  margin-top: 1rem;
}

form {
  display: flex;
  flex-direction: column;
  margin-top: 2rem;
  width: 30%;
  gap: 2rem;
}

label {
  display: block;
  margin-bottom: 8px;
}

input {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: #3065ac;
  color: #fff;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  text-align: center;
  color: #fff;
  font-weight: bolder;
  transition: ease-in 0.1s;
}

.voltarbtn {
  background: none;
  text-align: center;
  font-size: 14pt;
  font-weight: 600;
  color: var(--main-blue);
  border-radius: 6px;
  border: 2px solid var(--main-blue);
  padding: 0.6rem;
  width: auto;
  margin-top: 1rem;
  margin-bottom: 1rem;
  transition: all 0.2s;
}

button:hover {
  background-color: rgb(250, 0, 8);
}

section {
  font-family: "Inter", sans-serif;
  display: flex;
  flex-direction: column;
  align-items: start;
  width: 100%;
  gap: 1rem;
  margin-top: 2rem;
}

.turmas {
  display: inline-block;
}

h1 {
  font-size: 15pt;
  font-weight: 700;
  color: #3065ac;
}

h2 {
  font-size: 13pt;
  font-weight: 500;
  color: #252627;
}

main {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}

@media screen and (max-width: 672px) {
  form {
    width: 60%;
  }
}

@media screen and (max-width: 424px) {
  h1 {
    font-size: 14pt;
  }

  h2 {
    font-size: 10pt;
  }
}
</style>
