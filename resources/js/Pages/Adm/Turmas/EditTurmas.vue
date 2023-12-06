<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Aside from '@/Components/Aside.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, turma: Object, disciplinas: Object, professores: Object });

const form = useForm({
    semestre: props.turma.semestre,
    turno: props.turma.turno,
    horario: props.turma.horario,
    disciplina_id: props.turma.disciplina_id,
    professor_id: props.turma.professor_id,
});

const submit = () => {
    const id = props.turma.id;

    form.put(`/turmas/update/${id}`).then(response => {
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
            <h1>Atualizar turma</h1>
            <div class="forms">

                <div class="lado">
                    <div class="mt-4">
                        <InputLabel for="semestre" value="Semestre" />

                        <TextInput id="semestre" type="text" class="mt-1 block w-full"
                            v-model="form.semestre" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class="mt-4">
                        <InputLabel for="turno" value="Turno" />
    
                        <select id="turno" class="mt-1 block w-full" v-model="form.turno">
                            <option value="Manhã">Manhã</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noite">Noite</option>
                        </select>
    
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="horario" value="Horário" />
    
                        <TextInput id="horario" type="text" class="mt-1 block w-full" v-model="form.horario" />
    
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </div>

                <div class="lado2">
                    <div class="mt-4">
                        <InputLabel for="disciplina_id" value="Disciplina" />

                        <select name="disciplina_id" class="mt-1 block w-full" id="disciplina_id"
                            v-model="form.disciplina_id">
                            <option v-for="disciplina in props.disciplinas" :value="disciplina.id"> {{ disciplina.sigla }}
                            </option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="professor_id" value="Professor" />

                        <select name="professor_id" id="professor_id" class="mt-1 block w-full" v-model="form.professor_id">
                            <option v-for="professor in props.professores" :value="professor.id"> {{ professor.name }} </option>
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
