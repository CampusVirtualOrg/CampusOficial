<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Aside from '@/Components/Aside.vue';
import Card from '@/Components/Card.vue';
import Header from '@/Components/Header.vue';
import HeaderAluno from '@/Components/HeaderAluno.vue';

defineProps({ user: Object, disciplinas: Object })

</script>


<template>
    <Head title="Paniel Administrador" />
    <header>
        <HeaderAluno :nome="user.name" />
    </header>
    <section>
        <div class="content">
            <div class="texts">
                <h1>Disciplinas</h1>
                <div class="side">
                    <h2>Aluno: {{user.name}}</h2>
                    <h3>Curso: {{user.curso_id}}</h3>
                </div>
            </div>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Carga Horária</th>
                        <th>Pré Requisito</th>
                        <th>Curso</th>
                    </tr>
                </thead>
                <tbody v-for="disciplina in disciplinas">
                    <tr>
                        <td>{{ disciplina.nome }}</td>
                        <td>{{ disciplina.sigla }}</td>
                        <td>{{ disciplina.carga_horaria }}</td>
                        <td>{{ disciplina.pre_requisito_id }}</td>
                        <td>{{ disciplina.curso_id }}</td>
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
    width: 100%;
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
    margin-bottom: 2rem;
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
