<script setup>
import Aside from '@/Components/Aside.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ user: Object, cursos: Object, disciplinas: Object });

const form = useForm({
    nome: '',
    sigla: '',
    carga_horaria: '',
    pre_requisito_id: '',
    curso_id: '',
});

const submit = () => {
    form.post('/disciplinas/create').then(response => {
        alert(response.data);
    }).catch(error => {
        console.error(error.data);
        alert("Houve um erro ao criar disciplina.");
    });
};
</script>

<template>
    <main>
        <Aside :nome="props.user.name" :imagem="props.user.imagem" :tipo="props.user.tipo" />

        <Head title="Campus Virtual" />
        <form @submit.prevent="submit">
            <div class="lado">

                <div>
                    <InputLabel for="nome" value="Nome" />

                    <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" required autofocus
                      style="text-transform: uppercase;"   />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="sigla" value="Sigla" />

                    <TextInput id="sigla" type="text" class="mt-1 block w-full" v-model="form.sigla" required
                        v-mask="'AAAAA'" />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="carga_horaria" value="Carga Horária" />

                    <TextInput id="carga_horaria" type="number" class="mt-1 block w-full" v-model="form.carga_horaria"
                        maxlength="180" minlength="20" required />

                    <InputError class="mt-2" :message="form.errors.text" />
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

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="curso_id" value="Curso" />

                    <select name="curso_id" id="curso_id" class="mt-1 block w-full" v-model="form.curso_id">
                        <option v-for="curso in props.cursos" :value="curso.id"> {{ curso.nome }} </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>


                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Adicionar
                    </PrimaryButton>
                </div>
            </div>

        </form>
    </main>
</template>
<style scoped>
main {
    display: flex;
}

form {
    display: flex;
    gap: 1rem;
    align-items: baseline;
    justify-content: center;
    width: 100%;
}</style>
