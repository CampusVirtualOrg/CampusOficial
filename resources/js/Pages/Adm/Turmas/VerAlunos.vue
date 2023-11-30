<script setup>
import Aside from '@/Components/Aside.vue';
import HeaderAluno from "@/Components/HeaderAluno.vue";
import { defineProps } from "vue";

defineProps({ user: Object, alunos: Object, turma: Object });

</script>

<template>
	<section>
		<Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo" />
		<main>
			<h1>Alunos na turma: {{ turma.nome }}</h1>
            <h2>Professor: {{ turma.professor.name }}</h2>
            <h2>Disciplina: {{ turma.disciplina.nome }}</h2>
			<table>
				<thead>
					<tr>
						<th>Id do Aluno</th>
						<th>Nome</th>
                        <th>Faltas</th>
                        <th>Unidade 1</th>
                        <th>Unidade 2</th>
                        <th>Média Final</th>
					</tr>
				</thead>
				<tbody v-for="aluno in alunos">
					<tr>
						<td>{{ aluno.id }}</td>
						<td>{{ aluno.name }}</td>
                        <td>{{ aluno.faltas }}</td>
                        <td>{{ aluno.nota_unidade1 }}</td>
                        <td>{{ aluno.nota_unidade2 }}</td>
                        <td>{{ aluno.media_final }}</td>
					</tr>
				</tbody>
			</table>
		</main>
	</section>
</template>

<style scoped>
* {
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
	font-family: 'Inter', sans-serif;
}

section {
	display: flex;
	width: 100%;
}

main {
	display: flex;
	flex-direction: column;
	align-items: center;
	width: 100%;
}

h1 {
	font-size: 18pt;
	font-weight: 600;
	color: #3065ac;
	margin-top: 2rem;
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
