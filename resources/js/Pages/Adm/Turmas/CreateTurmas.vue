<script setup>
import Aside from '@/Components/Aside.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, professores: Object, disciplinas: Object });

const form = useForm({
    nome: '',
    semestre: '',
    turno: '',
    professor_id: ''
});

const submit = () => {
    form.post('/turma/create').then(response => {
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
                        autocomplete="nome" />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="semestre" value="semestre" />

                    <TextInput id="semestre" type="text" class="mt-1 block w-full" v-model="form.semestre" required
                        maxlength="4" />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="turno" value="Turno" />

                    <TextInput id="turno" type="number" class="mt-1 block w-full" v-model="form.turno"
                        maxlength="180" minlength="20" required />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

            </div>
            <div class="lado2">

                <div class="mt-4">
                    <InputLabel for="professor_id" value="Pré Requisito" />

                    <select name="professor_id" class="mt-1 block w-full" id="professor_id"
                        v-model="form.pre_requisito_id">
                        <option v-for="professores in props.professor" :value="professor_id"> {{ professor.name }}
                        </option>
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
