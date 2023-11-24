<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
import { Head } from '@inertiajs/vue3';
import { defineProps } from "vue";

defineProps({ user: Object })

</script>

<template>
	<Head title="Boletim" />
	<header>
		<HeaderAluno :nome="user.name" />
	</header>

	<div class="title">
		<h1>Boletim</h1>
	</div>

	<div class="content">
		<table>
			<thead>
				<tr>
					<th>Componente Curricular</th>
					<th>1º Unidade</th>
					<th>Faltas</th>
					<th>2º Unidade</th>
					<th>Faltas</th>
					<th>Média</th>
					<th>Situação</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(user, id) in dados" :key="user.id">
					<td>{{ user.name }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<style scoped>
* {
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
  font-family: 'Inter', sans-serif;
}

.title {
	margin: 30px 0px;
	color: #3065ac;
  	font-size: 25pt;
	font-weight: 600;
  	margin-left: 2rem;
}

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
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  margin-top: 1rem;
}

.content {
    display: flex;
	align-items: center;
	justify-content: center;
    width: 100%;
    gap: 1rem;
    padding: 0rem 2rem;
    flex-wrap: wrap;
}

section {
    display: flex;
    flex-direction: column;
    width: 100%;
}


table {
    width: 100%;
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
</style>
