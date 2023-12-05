<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Aside from '@/Components/Aside.vue';
import Header from '@/Components/Header.vue';
import { RiEdit2Fill } from "oh-vue-icons/icons";

const props = defineProps({
    user: Object,
    requerimentos: Object
})

</script>


<template>
    <Head title="Paniel Administrador" />

    <main class="mainAdmin">
        <Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo"/>

        <section>
            <Header />
            <div class="content">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Observações</th>
                            <th>Status</th>
                            <!-- <th>Data</th> -->
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody v-for="requerimento in requerimentos" :key="requerimento.id">
                        <tr>
                            <td>{{ requerimento.nome_usuario }}</td>
                            <td>{{ requerimento.email_usuario }}</td>
                            <td>{{ requerimento.tipo_requerimento }}</td>
                            <td>{{ requerimento.observacoes }}</td>
                            <td>{{ requerimento.status }}</td>
                            <!-- <td>{{ requerimento.created_at }}</td> -->
                            <td style="color: #3065ac;">
                                <Link :href="`/requerimentos/edit/${requerimento.id}`"><i class="bi bi-pencil-fill mx-2"></i></Link>
                                <Link :href="`/requerimentos/remove/${requerimento.id}`"><i class="bi bi-trash-fill mx-2"></i></Link>
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

bi bi-trash-fill{
    color: blue;
}

.content {
    display: flex;
    width: 100%;
    gap: 1rem;
    padding: 2rem;
    flex-wrap: wrap;
}

section {
    display: flex;
    gap: 2rem;
    flex-direction: column;
    width: 100%;
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
