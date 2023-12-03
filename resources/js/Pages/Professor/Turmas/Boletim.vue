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
                        <th>Aluno</th>
                        <th>Faltas</th>
                        <th>Unidade 1</th>
                        <th>Unidade 2</th>
                        <th>Média Final</th>
						<th>config</th>

                    </tr>
                </thead>
                <tbody v-for="aluno in alunos">
                    <tr>
                        <td>{{ aluno.id }}</td>
                        <td>{{ aluno.name }}</td>
                        <td>{{ aluno.faltas }}</td>
                        <td>{{ aluno.nota_unidade1 }}</td>
                        <td>{{ aluno.nota_unidade2 }}</td>
                        <td class="media" v-if="aluno.media_final >= 7"><span class="text-green-800">{{ aluno.media_final }}</span></td>
                        <td class="media" v-else><span class="text-red-800">{{ aluno.media_final }}</span></td>
						<td><form :action="'/professor/turmas/editarview/'+aluno.id" method="get">
							<input name="turma_id" hidden :value="turma.id">
							<button type="submit">ir</button>
						</form></td>
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
button{
	text-align: center;
	color:red;
	font-weight: bolder;
}

section {
    font-family: 'Inter', sans-serif;
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
