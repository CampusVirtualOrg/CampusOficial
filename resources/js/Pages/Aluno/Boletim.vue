<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
import { Head } from '@inertiajs/vue3';
import { defineProps } from "vue";

defineProps({ user: Object, turmas: Object })

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
					<h2>Aluno: {{ user.name }}</h2>
					<h3>Curso: {{ user.curso.nome }}</h3>
				</div>
			</div>
			<table>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Disciplina</th>
						<th>Carga Horária</th>
						<th>Professor</th>
						<th>Faltas</th>
						<th>Unidade 1</th>
						<th>Unidade 2</th>
						<th>Média Final</th>

					</tr>
				</thead>
				<tbody v-for="turma in turmas">
					<tr>
						<td>{{ turma.nome_turma }}</td>
						<td>{{ turma.nome_disciplina }}</td>
						<td>{{ turma.carga_horaria_disciplina }}h</td>
						<td>{{ turma.nome_professor }}</td>
						<td v-if="turma.porcentagem_faltas < 30">
							<span class="avisoFaltas text-green-800" title="Está com a presença em dia!">
								{{ turma.faltas }}
							</span>
						</td>
						<td v-else-if="(turma.porcentagem_faltas >= 30) && (turma.porcentagem_faltas < 45)">
							<span class="avisoFaltas text-yellow-600" title="Cuidado! Está somando muitas faltas">
								{{ turma.faltas }}
							</span>
						</td>
						<td v-else-if="(turma.porcentagem_faltas >= 45)">
							<span class="avisoFaltas text-red-800" title="Reprovado por falta ):">
								{{ turma.faltas }}
							</span>
						</td>
						<td>{{ turma.nota_unidade1 }}</td>
						<td>{{ turma.nota_unidade2 }}</td>
						<td class="media" v-if="turma.media_final >= 7"><span
								class="text-green-800">{{ turma.media_final }}</span></td>
						<td class="media" v-else><span class="text-red-800">{{ turma.media_final }}</span></td>
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
	gap: 0.6rem;
	width: 80%;
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

h2,
h3 {
	font-size: 14pt;
	color: #252627;
	font-weight: 600;
}

.avisoFaltas {
	font-weight: 800;
}

.media {
	font-weight: 800;
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

@media screen and (max-width: 864px) {

	tr,
	td,
	th {
		border: 1px solid black;
		text-align: center;
		padding: 0.1rem;
		font-size: 11pt;
	}

	th {
		padding: 1px;
		background-color: #3065ac;
		color: #ffffff;
		font-size: 12pt;
	}

	h1 {
		font-size: 20pt;
	}

	h2,
	h3 {
		font-size: 12pt;
	}
}
</style>
