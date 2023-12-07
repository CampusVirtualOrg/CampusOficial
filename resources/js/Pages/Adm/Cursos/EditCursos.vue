<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Aside from '@/Components/Aside.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, curso: Object, })

const form = useForm({
    nome: props.curso.nome,
    carga_horaria: props.curso.carga_horaria,
    periodos: props.curso.periodos,
    sigla: props.curso.sigla,
    categoria: props.curso.categoria,
    descricao: props.curso.descricao,
});

const submit = () => {
    const id = props.curso.id;

    form.put(`/cursos/update/${id}`).then(response => {
        alert(response.data);
        // Redirecionomento ou atualização da interface após a edição
    }).catch(error => {
        // Lógica para lidar com erros, se houver algum
        console.error(error.data); // Mostra o erro no console
        alert("Houve um erro ao editar usuario.");
    });
};
</script>

<template>
    <main>
        <Aside :nome="user.nome" :imagem="user.imagem" :tipo="user.tipo" />

        <Head title="Campus Virtual" />
        <form @submit.prevent="submit">
            <h1>Atualizar curso</h1>
            <div class="forms">

                <div class="lado">
                    <div>
                        <InputLabel for="nome" value="Nome" />

                        <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="carga_horaria" value="Carga Horária" />

                        <TextInput id="carga_horaria" type="number" class="mt-1 block w-full" v-model="form.carga_horaria" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="periodos" value="Períodos" />

                        <TextInput id="periodos" type="number" class="mt-1 block w-full" v-model="form.periodos" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                </div>

                <div class="lado2">
                    <div class="mt-4">
                        <InputLabel for="sigla" value="Sigla" />

                        <TextInput id="sigla" type="text" class="mt-1 block w-full" v-model="form.sigla" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="categoria" value="Categoria" />

                        <select id="categoria" class="mt-1 block w-full" v-model="form.categoria" required>
                            <option value="Técnico">Técnico</option>
                            <option value="Tecnólogo">Tecnólogo</option>
                            <option value="Bacharelado">Bacharelado</option>
                            <option value="Licenciatura">Licenciatura</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="descricao" value="Descricao" />

                        <TextInput id="descricao" type="text" class="mt-1 block w-full" v-model="form.descricao" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Atualizar
                        </PrimaryButton>
                        {{ professores }}
                    </div>
                </div>

            </div>
        </form>

    </main>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
main {
    display: flex;
    font-family: 'Inter', sans-serif;
}

form {
    width: 100%;
    display: flex;
    flex-direction: column;
    margin-top: 5%;
    align-items: center;
}

h1 {
    font-size: 20pt;
    font-weight: 800;
    color: #3065ac;
}

.forms {
    display: flex;
    gap: 1rem;
    align-items: first baseline;
    justify-content: center;
    width: 100%;
}

.lado,
.lado2,
.lado3 {
    display: flex;
    flex-direction: column;
    height: 100%;
    justify-content: center;
}
</style>
