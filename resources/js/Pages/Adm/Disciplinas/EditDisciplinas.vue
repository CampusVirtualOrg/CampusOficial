<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Aside from '@/Components/Aside.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, disciplina: Object, disciplinas: Object, cursos: Object})

const form = useForm({
    nome: props.disciplina.nome,
    carga_horaria: props.disciplina.carga_horaria,
    sigla: props.disciplina.sigla,
    pre_requisito_id: props.disciplina.pre_requisito_id,
    curso_id: props.disciplina.curso_id,
});

const submit = () => {
    const id = props.disciplina.id;

    form.put(`/disciplinas/update/${id}`).then(response => {
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
            <h1>Atualizar disciplina</h1>
            <div class="forms">

                <div class="lado">
                    <div>
                        <InputLabel for="nome" value="Nome" />

                        <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="carga_horaria" value="Carga Horária" />

                        <TextInput id="carga_horaria" type="number" class="mt-1 block w-full"
                            v-model="form.carga_horaria" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class="mt-4">
                        <InputLabel for="sigla" value="Sigla" />
    
                        <TextInput id="sigla" type="text" class="mt-1 block w-full" v-model="form.sigla" />
    
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </div>

                <div class="lado2">
                    <div class="mt-4">
                        <InputLabel for="pre_requisito_id" value="Pré Requisito" />

                        <select name="pre_requisito_id" class="mt-1 block w-full" id="pre_requisito_id"
                            v-model="form.pre_requisito_id">
                            <option v-for="disciplina in props.disciplinas" :value="disciplina.id"> {{ disciplina.sigla }}
                            </option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="curso_id" value="Curso" />

                        <select name="curso_id" id="curso_id" class="mt-1 block w-full" v-model="form.curso_id">
                            <option v-for="curso in props.cursos" :value="curso.id"> {{ curso.nome }} </option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Atualizar
                        </PrimaryButton>
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
