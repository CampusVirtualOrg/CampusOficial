<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
import { defineProps } from "vue";

defineProps({ user: Object, alunos: Object, turma: Object });

</script>

<template>
	<header>
	<HeaderAluno :nome="user.name" />
  </header>
  	<main>
 		<h1>Alunos na turma: </h1>

		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Matrícular</th>
				</tr>
			</thead>
			<tbody v-for="aluno in alunos">
				<tr>
					<td>{{ aluno.name }}</td>
					<td style="color: #3065ac;">
						<form :action="`/turmas/alunos/${turma}`" method="POST">
							<input type="hidden" name="aluno_id" :value="aluno.id">
							<button type="submit" class="btn btn-primary">Registrar</button>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
	</main>
</template>

<style scoped>

* {
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
	font-family: 'Inter', sans-serif;
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
