<script setup>
import Aside from '@/Components/Aside.vue';
import HeaderAluno from "@/Components/HeaderAluno.vue";
import { defineProps } from "vue";

defineProps({ curso: Object ,user: Object, alunos: Object, turma: Object });

</script>

<template>

	<section>
		<Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo" />
		<main>
			<h1>Alunos disponíveis para turma: </h1>
			<table>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Curso</th>
						<th>Matrícular</th>

					</tr>
				</thead>
				<tbody v-for="aluno in alunos">
					<tr>
						<td>{{ aluno.name }}</td>
						<td v-for="c in curso">{{ c.nome }}</td>
						<td style="color: #3065ac;">
							<form :action="`/turma/alunos/${turma.id}`" method="post">
								<input type="hidden" name="aluno_id" :value="aluno.id">
								<button type="submit" class="btn btn-primary">Matrícular</button>
							</form>
						</td>
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

@media screen and (max-width: 724px) {
	h1 {
		font-size: 14pt;
	}

	h2 {
		font-size: 10pt;
	}

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
}
</style>
