<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Aside from '@/Components/Aside.vue';
import Card from '@/Components/Card.vue';
import Header from '@/Components/Header.vue';

defineProps({ user: Object, turmas: Object })

</script>


<template>
    <Head title="Paniel Administrador" />

    <main class="mainAdmin">
        <Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo" />

        <section>
            <Header />
            <div class="content">
                <Link :href="route('turmas.create.view')" class="buttonAdd">+ Adicionar Nova Turma</Link>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Semestre</th>
                            <th>Turno</th>
                            <th>Horário</th>
                            <th>Disciplina</th>
                            <th>Professor</th>
                            <th>Ver Alunos</th>
                            <th>Adicionar Aluno</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody v-for="turma in turmas">
                        <tr>
                            <td>{{ turma.nome }}</td>
                            <td>{{ turma.semestre }}</td>
                            <td>{{ turma.turno }}</td>
                            <td>{{ turma.horario }}</td>
                            <td>{{ turma.disciplina.nome}}</td>
                            <td>{{ turma.professor.name}}</td>
                            <td><Link :href="`/turmas/alunos/${turma.id}`">Ver</Link></td>
                            <td><Link :href="`/turmas/addalunos/${turma.id}`">Adicionar aluno</Link></td>
                            <td style="color: #3065ac;">
                                <Link :href="`/turmas/edit/${turma.id}`"><i class="bi bi-pencil-fill mx-2"></i></Link>
                                <Link :href="`/turmas/remove/${turma.id}`"><i class="bi bi-trash-fill mx-2"></i></Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</template>

<style scoped>
.mainAdmin {
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
    font-family: 'Inter', sans-serif;
    display: flex;
}

.content {
    display: flex;
    width: 100%;
    gap: 1rem;
    padding: 0rem 2rem;
    flex-wrap: wrap;
}

section {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.buttonAdd {
    background: none;
    text-align: center;
    font-size: 14pt;
    font-weight: 600;
    color: var(--main-blue);
    border-radius: 6px;
    border: 2px solid var(--main-blue);
    padding: 0.6rem;
    width: auto;
    margin-top: 1rem;
    margin-bottom: 1rem;
    transition: all 0.2s;
}

.buttonAdd:hover {
    color: var(--white);
    background-color: var(--main-blue);
    cursor: pointer;
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
