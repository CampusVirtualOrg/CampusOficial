<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Aside from '@/Components/Aside.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ userAuth: Object, user: Object, cursos: Object })

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
    password_confirmation: props.user.password_confirmation,
    tipo: props.user.tipo,
    telefone: props.user.telefone,
    cpf: props.user.cpf,
    sexo: props.user.sexo,
    endereco: props.user.endereco,
    data_nasc: props.user.data_nasc,
    curso_id: props.user.curso_id,
    imagem: props.user.imagem,
});

const submit = () => {
    const id = props.user.id;

    form.put(`/usuarios/update/${id}`).then(response => {
        alert(response.data);
        // Redirecionamento ou atualização da interface após a edição
    }).catch(error => {
        // Lógica para lidar com erros, se houver algum
        console.error(error.data); // Mostra o erro no console
        alert("Houve um erro ao editar usuario.");
    });
};
</script>

<template>
    <main>
        <Aside :nome="userAuth.name" :imagem="userAuth.imagem" :tipo="userAuth.tipo" />
        
        <Head title="Campus Virtual" />
        <form @submit.prevent="submit">
            <div class="lado">
                <div>
                    <InputLabel for="name" value="Nome" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Senha" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                        autocomplete="new-password" minlength="8" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirme a Senha" minlength="8" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4">
                    <InputLabel for="tipo" value="Tipo" />

                    <select id="tipo" class="mt-1 block w-full" v-model="form.tipo">
                        <option value="Administrador">Administrador</option>
                        <option value="Professor">Professor</option>
                        <option value="Aluno">Aluno</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="telefone" value="Telefone" />

                    <TextInput id="telefone" type="text" class="mt-1 block w-full" v-model="form.telefone" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
            </div>

            <div class="lado2">
                <div class="mt-4">
                    <InputLabel for="cpf" value="CPF" />

                    <TextInput id="cpf" type="text" class="mt-1 block w-full" v-model="form.cpf" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="sexo" value="Sexo" />

                    <select id="sexo" class="mt-1 block w-full" v-model="form.sexo">
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Outro">Outro</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="endereco" value="Endereço" />

                    <TextInput id="endereco" type="text" class="mt-1 block w-full" v-model="form.endereco" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="data_nasc" value="Data de nascimento" />

                    <TextInput id="data_nasc" type="date" class="mt-1 block w-full" v-model="form.data_nasc" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="curso_id" value="Curso" />

                    <select name="curso_id" id="curso_id" class="mt-1 block w-full" v-model="form.curso_id">
                        <option v-for="curso in props.cursos" :value="curso.id">{{ curso.nome }}</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="imagem" value="Imagem" />

                    <TextInput id="imagem" type="text" class="mt-1 block w-full" v-model="form.imagem" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>


                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
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
}
</style>
