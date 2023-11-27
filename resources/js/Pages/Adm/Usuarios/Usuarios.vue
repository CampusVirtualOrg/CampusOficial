<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Aside from '@/Components/Aside.vue';
import Card from '@/Components/Card.vue';
import Header from '@/Components/Header.vue';

defineProps({ user: Object, users: Object })

</script>


<template>
    <Head title="Paniel Administrador" />

    <main class="mainAdmin">
        <Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo"/>

        <section>
            <Header :action="'/usuarios/search'"/>
            <div class="content">
                <Link :href="route('register')" class="buttonAdd">+ Adicionar Novo Usuário</Link>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th><Link :href="'usuarios/search'">Nome<i class="bi bi-arrow-up"></i></Link></th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <!-- <th>Matricula</th> -->
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Sexo</th>
                            <th>Data</th>
                            <th>Curso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody v-for="usuario in users">
                        <tr>
                            <td>{{ usuario.name }}</td>
                            <td>{{ usuario.email }}</td>
                            <td>{{ usuario.tipo }}</td>
                            <!-- <td>{{ usuario.matricula }}</td> -->
                            <td>{{ usuario.telefone }}</td>
                            <td>{{ usuario.cpf }}</td>
                            <td>{{ usuario.sexo }}</td>
                            <td>{{ usuario.data_nasc }}</td>
                            <td>{{ usuario.curso }}</td>
                            <td style="color: #3065ac;">
                                <Link :href="`/usuarios/edit/${usuario.id}`"><i class="bi bi-pencil-fill mx-2"></i></Link>
                                <Link :href="`/usuarios/remove/${usuario.id}`"><i class="bi bi-trash-fill mx-2"></i></Link>
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
