<script setup>
import Aside from '@/Components/Aside.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({ user: Object, disciplinas: Object, professores: Object });

const form = useForm({
    semestre: '',
    turno: '',
    horario: '',
    disciplina_id: '',
    professor_id: ''
});

const submit = () => {
    form.post('/turmas/create', form.data()).then(response => {
        console.log(response.data);
        alert(response.data);
    }).catch(error => {
        console.error(error.data);
        alert("Houve um erro ao criar turma.");
    });
};
</script>

<template>
    <main>
        <Aside :nome="user.name" :imagem="user.imagem" :tipo="user.tipo" />

        <Head title="Campus Virtual" />
        <form @submit.prevent="submit">
            <h1>Cadastrar disciplina</h1>
            <div class="forms">
                <div class="lado">
                    <div class="mt-4">
                        <InputLabel for="semestre" value="Semestre letivo" />

                        <TextInput id="semestre" type="text" class="mt-1 block w-full" v-model="form.semestre" required
                            v-mask="'####.#'" placeholder="ex: 2023.2" />

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="turno" value="Turno" />

                        <select id="turno" class="mt-1 block w-full" v-model="form.turno">
                            <option value="Manhã">Manhã</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noite">Noite</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                </div>
                <div class="lado2">

                    <div class="mt-4">
                        <InputLabel for="horario" value="Horário das aulas" />

                        <TextInput id="horario" type="text" class="mt-1 block w-full" v-model="form.horario" required
                            v-mask="'AAA ##:## - ##:##'" placeholder="ex: SEG 09:00 - 11:30" />

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="disciplina_id" value="Disciplina da turma" />

                        <select name="disciplina_id" class="mt-1 block w-full" id="disciplina_id"
                            v-model="form.disciplina_id">
                            <option v-for="disciplina in disciplinas" :key="disciplina.id" :value="disciplina.id">
                                {{ disciplina.nome }}
                            </option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="professor_id" value="Professor da turma" />

                        <select name="professor_id" class="mt-1 block w-full" id="professor_id" v-model="form.professor_id">
                            <option v-for="professor in professores" :key="professor.id" :value="professor.id">
                                {{ professor.name }}
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
