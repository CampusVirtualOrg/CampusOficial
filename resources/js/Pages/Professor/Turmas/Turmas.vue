<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HeaderAluno from '@/Components/HeaderAluno.vue';

defineProps({
	user: Object, turmas: Object
})
</script>


<template>
	<Head title="Turmas Professor" />
	<header>
		<HeaderAluno :nome="user.name" />
	</header>

	<section>
		<div class="title">
			<h1>Minhas Turmas</h1>
		</div>

		<div class="todasTurmas">

			<div class="turmas" v-for="turma in turmas">
				<div class="card">
					<h4>{{ turma.nome }}</h4>
					<p>
						{{ turma.horario }}
					</p>
					<Link :href="`/professor/turmas/${turma.id}`" class="anc">Exibir turma</Link>
				</div>
			</div>

		</div>
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
	padding: 0rem 2.5rem;
	flex-direction: column;
	align-items: start;
	width: 100%;
	gap: 1rem;
}

.title {
	display: flex;
	align-items: center;
	margin-top: 1rem;
	font-size: 24pt;
	font-weight: 800;
	color: #3065ac;
}

.todasTurmas {
	display: flex;
	flex-wrap: wrap;
	gap: 1rem;
	width: 100%;
}

.card {
	font-size: 14pt;
	font-weight: 500;
	background-color: #3065ac;
	width: 16rem;
	height: 8rem;
	color: white;
	padding: 1rem;
	border: 2px solid transparent;
	border-radius: 15px;
	transition: all 0.3s ease;
}

.anc {
	font-weight: 700;
}
</style>
