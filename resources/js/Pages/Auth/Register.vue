<script setup>
import Aside from '@/Components/Aside.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, cursos: Object });

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    tipo: '',
    telefone: '',
    cpf: '',
    sexo: '',
    endereco: '',
    data_nasc: '',
    curso_id: '',
});

const submit = () => {
    form.post(route('users.register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <main>
        <Aside :nome="props.user.name" :imagem="props.user.imagem" :tipo="props.user.tipo" />

        <Head title="Campus Virtual" />
        <form @submit.prevent="submit">
            <h1>Registrar usuário</h1>
            <div class="forms">
                <div class="lado">
                    <div>
                        <InputLabel for="name" value="Nome" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                            autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Senha" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                            autocomplete="new-password" minlength="8" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirme a Senha" minlength="8" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>


                </div>
                <div class="lado2">

                    <div class="mt-4">
                        <InputLabel for="tipo" value="Tipo" />

                        <select id="tipo" class="mt-1 block w-full" v-model="form.tipo" required>
                            <option value="Administrador">Administrador</option>
                            <option value="Professor">Professor</option>
                            <option value="Aluno">Aluno</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="telefone" value="Telefone" />

                        <TextInput id="telefone" type="text" class="mt-1 block w-full" v-model="form.telefone" required />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="cpf" value="CPF" />

                        <TextInput id="cpf" type="text" class="mt-1 block w-full" v-model="form.cpf" required />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="sexo" value="Sexo" />

                        <select id="sexo" class="mt-1 block w-full" v-model="form.sexo" required>
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Outro">Outro</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                </div>
                <div class="lado3">
                    <div class="mt-4">
                        <InputLabel for="endereco" value="Endereço" />

                        <TextInput id="endereco" type="text" class="mt-1 block w-full" v-model="form.endereco" required />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="data_nasc" value="Data de nascimento" />

                        <TextInput id="data_nasc" type="date" class="mt-1 block w-full" v-model="form.data_nasc" required />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="curso_id" value="Curso" />

                        <select name="curso_id" id="curso_id" class="mt-1 block w-full" v-model="form.curso_id">
                            <option value="">Nenhum</option>
                            <option v-for="curso in props.cursos" :value="curso.id">{{ curso.nome }}</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Cadastrar
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
