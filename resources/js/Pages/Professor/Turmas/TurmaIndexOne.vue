<script setup>
import { Head, Link } from "@inertiajs/vue3";
import HeaderAluno from "@/Components/HeaderAluno.vue";

defineProps({
  user: Object,
  turma: String,
  alunos: Object,
});
</script>

<template>
  <Head title="Turmas Professor" />
  <header>
    <!-- <HeaderAluno :nome="user.name" /> -->
  </header>

  <section>

    <main>
      <!-- <h1>Turma: {{ turma.nome }}</h1> -->
      <!-- <h2>Disciplina: {{ turma.disciplina.nome }}</h2> -->
     <form :action="'/professor/turmas/editar/'+user" method="post">

		<input type="text" placeholder="faltas" name="faltas" :value="alunos.faltas" />

        <input type="text" placeholder="notas 1°unidade" name="nu1" :value="alunos.nota_unidade1" />

        <input type="text" placeholder="notas 2°unidade" name="nu2" :value="alunos.nota_unidade2" />
		<input hidden  name="turma_id" :value="turma.turma_id" />

        <span class="text-green-800">{{ alunos.media_final }}</span>

        <span class="text-red-800">{{ alunos.media_final }}</span>

        <button type="submit">atualizar</button>
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
    background-color: white;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: mediumspringgreen;
}
button {
  text-align: center;
  color: red;
  font-weight: bolder;
}

section {
  font-family: "Inter", sans-serif;
  display: flex;
  flex-direction: column;
  align-items: start;
  width: 100%;
  gap: 1rem;
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

table {
  margin: 2rem 0rem;
  width: 50%;
  border: 1px solid #000;
  border-collapse: collapse;
}

tr,
td,
th {
  border: 1px solid black;
  text-align: center;
  padding: 0.4rem;
  background-color: #fff;
}

th {
  padding: 0.6rem;
  background-color: #3065ac;
  color: #ffffff;
  font-size: 14pt;
}

input {
  width: 6rem;
  font-size: 11pt;
}

.media {
  font-weight: 800;
}
</style>
