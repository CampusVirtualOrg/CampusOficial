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
        <Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo" />

        <Head title="Campus Virtual" />
        <form @submit.prevent="submit">
            <h1>Cadastrar curso</h1>
            <div class="forms">
                <div class="lado">

                    <div>
                        <InputLabel for="nome" value="Nome" />

                        <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" required autofocus
                            style="text-transform: uppercase;" />

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="carga_horaria" value="Carga horaria" />

                        <TextInput id="carga_horaria" type="number" class="mt-1 block w-full" v-model="form.carga_horaria"
                            required v-mask="'##:##'" />

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="periodos" value="Periodos" />

                        <TextInput id="periodos" type="number" class="mt-1 block w-full" v-model="form.periodos" required />

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                </div>
                <div class="lado2">

                    <div class="mt-4">
                        <InputLabel for="sigla" value="Sigla" />

                        <TextInput id="sigla" type="text" class="mt-1 block w-full" v-model="form.sigla" required />

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="categoria" value="Categoria" />

                        <select name="categoria" class="mt-1 block w-full" id="categoria" v-model="form.categoria">
                            <option value="Técnico">Técnico</option>
                            <option value="Superior">Superior</option>
                            <option value="Pós-Graduação">Pós-Graduação</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="descricao" value="Descrição" />

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

@media screen and (max-width: 912px) {
    .forms {
        flex-direction: column;
        align-items: center;
    }
}

@media screen and (max-width: 424px) {
    h1 {
        font-size: 16pt;
    }
}
</style>
