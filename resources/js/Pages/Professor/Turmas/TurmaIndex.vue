<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HeaderAluno from '@/Components/HeaderAluno.vue';

defineProps({
	user: Object, turma: Object, alunos: Object
})
</script>


<template>
	<Head title="Turmas Professor" />
	<header>
		<HeaderAluno :nome="user.name" />
	</header>

	<section>
		<main>
			<h1>Turma: {{ turma.nome }}</h1>
            <h2>Disciplina: {{ turma.disciplina.nome }}</h2>
			<table>
				<thead>
					<tr>
						<th>Id do Aluno</th>
						<th>Nome</th>
                        <th>Faltas</th>
                        <th>Notas</th>
					</tr>
				</thead>
				<tbody v-for="aluno in alunos">
					<tr>
						<td>{{ aluno.id }}</td>
						<td>{{ aluno.name }}</td>
                        <td>{{ aluno.faltas }}</td>
                        <td>{{ aluno.notas }}</td>
					</tr>
				</tbody>
			</table>
		</main>
	</section>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
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
	display: flex;
	margin: 0rem 2.5rem;
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
	margin-top: 2rem;
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
</style>
