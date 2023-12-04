<script setup>
import Aside from '@/Components/Aside.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { defineProps } from 'vue';



defineProps({ user: Object });

const form = useForm({
    nome: '',
    carga_horaria: '',
    periodos: '',
    sigla: '',
    categoria: '',
    descricao: '',
});



const submit = () => {
    form.post('/cursos/create').then(response => {
        alert(response.data);
    }).catch(error => {
        console.error(error.data);
        alert("Houve um erro ao criar disciplina.");
    });
};
</script>

<template>
    <main>
        <Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo"/>

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
                    <InputLabel for="carga_horaria" value="Carga_horaria" />

                    <TextInput id="carga_horaria" type="number" class="mt-1 block w-full" v-model="form.carga_horaria" required
                        v-mask="'##:##'" />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="periodos" value="Periodos" />

                    <TextInput id="periodos" type="number" class="mt-1 block w-full" v-model="form.periodos"
                       required />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

            </div>
            <div class="lado2">

                <div class="mt-4">
                    <InputLabel for="sigla" value="Sigla" />

                    <TextInput id="sigla" type="text" class="mt-1 block w-full" v-model="form.sigla"
                        required />

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

				<div class="mt-4">
                    <InputLabel for="categoria" value="Categoria" />

                    <select name="categoria" class="mt-1 block w-full" id="categoria"
                        v-model="form.categoria">
                        <option value="Técnico">Técnico</option>
                        <option value="Superior">Superior</option>
                        <option value="Pós-Graduação">Pós-Graduação</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-4">
                    <InputLabel for="descricao" value="descricao" />

					<TextInput id="cdescricao" type="text" class="mt-1 block w-full" v-model="form.descricao"
                        required />

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
