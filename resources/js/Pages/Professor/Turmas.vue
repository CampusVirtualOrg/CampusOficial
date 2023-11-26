<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HeaderAluno from '@/Components/HeaderAluno.vue';

defineProps({
	user: Object, turmas: Object
})
</script>


<template>
	<header>
        <HeaderAluno :nome="user.name"/>
    </header>

	<Head title="Turmas Professor" />

	<div class="title">
		<h1> Minhas Turmas</h1>
	</div>

	<div class="turmas" v-for="turma in turmas">
		<div class="card">
			<h4>{{ turma.nome }}</h4>
			<p>
				{{ turma.horario }}
			</p>
			<Link>Exibir turma</Link>
		</div>
	</div>
</template>

<style scoped>

header {
  display: flex;
  align-items: center;
  width: 100vw;
  justify-content: space-between;
  position: relative;
  top: 0;
  margin-top: 1rem;
}

.title {
	margin: 20px;
	display: flex;
  	align-items: center;
  	margin-top: 1rem;
	font-size: 30px;
	color: black;
}
.turmas {
	display: inline-block;
}
.card{
	font-size: 20px;
	background-color: #3065ac;
	width: 50vh;
	height: 20vh;
	color: aliceblue;
	padding: 1rem;
	margin: 20px;
	border: 2px solid transparent;
	border-radius: 15px;
	transition: all 0.3s ease;
}

section {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  margin-top: 1rem;
}
</style>
