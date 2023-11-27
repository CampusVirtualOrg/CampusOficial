<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
import { Head } from '@inertiajs/vue3';
import { defineProps } from "vue";

defineProps({ user: Object, disciplinas: Object })

</script>

<template>
	<Head title="Boletim" />
	<header>
		<HeaderAluno :nome="user.name" />
	</header>

	<section>
		<div class="content">
			<div class="texts">
                <h1>Boletim</h1>
                <div class="side">
                    <h2>Aluno: {{user.name}}</h2>
                    <h3>Curso: {{user.curso_id}}</h3>
                </div>
            </div>
			<table>
				<thead>
					<tr>
						<th>Disciplina</th>
						<th>1º Unidade</th>
						<th>Faltas</th>
						<th>2º Unidade</th>
						<th>Faltas</th>
						<th>Média</th>
						<th>Situação</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="disciplina in disciplinas" :key="disciplina.id">
						<td>{{ disciplina.nome }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
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
	font-weight: 800;
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
	width: 100%;
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
	margin-top: 1rem;
}

.texts {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

h1 {
    font-size: 28pt;
    font-weight: 800;
    color: #3065ac;
}

h2, h3 {
    font-size: 14pt;
    color: #252627;
    font-weight: 600;
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
