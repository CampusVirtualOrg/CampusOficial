<script setup>
import { Link } from '@inertiajs/vue3';
import Logo from '@/Components/Logo.vue';
import { ref } from 'vue';

const props = defineProps({
    nome: String,
    imagem: String,
    tipo: String,
})

const isExpanded = ref(false);

const toggleMenu = () => {
    isExpanded.value = !isExpanded.value;
}
</script>

<template>
    <aside :class="`${isExpanded && 'isExpanded'}`">

        <div class="perfil" v-if="imagem">
            <img :src="imagem" alt="" class="img-perfil mx-2" />
            <div v-if="isExpanded" class="text-perfil">
                <p class="text-white">Olá, <span style="color: white; font-weight: 600;">{{ nome }}</span></p>
                <span class="tipo-text">{{ tipo }}</span>
            </div>
        </div>
        <div class="perfil" v-else>
            <div class="img-perfil">
                <img src="../../../public/assets/img/perfil-default.png" alt="" class="mx-2" />
            </div>
            <div v-if="isExpanded" class="text-perfil">
                <p class="text-white">Olá, <span style="color: white; font-weight: 700;">{{ nome }}</span></p>
                <span class="tipo-text">{{ tipo }}</span>
            </div>
        </div>

        <div class="dropdown-toggle" @click="toggleMenu">
            <i v-if="isExpanded" class="bi bi-arrow-left-circle-fill"></i>
            <i v-else class="bi bi-arrow-right-circle-fill"></i>
        </div>

        <div v-if="isExpanded" class="anchorsExpanded">
            <Link :href="route('users')" title="Usuários" class="a-asclasse"><i class="bi bi-people-fill"></i><span
                v-if="isExpanded">Usuários</span></Link>

            <Link :href="route('cursos')" title="Cursos" class="a-asclasse"><i class="bi bi-c-square-fill"></i><span
                v-if="isExpanded">Cursos</span></Link>

            <Link :href="route('disciplinas')" title="Disciplinas" class="a-asclasse"><i class="bi bi-book-half"></i><span
                v-if="isExpanded">Disciplinas</span></Link>

            <Link :href="route('turmas')" title="Turmas" class="a-asclasse"><i class="bi bi-easel2-fill"></i><span
                v-if="isExpanded">Turmas</span></Link>

            <Link :href="route('requerimentos')" title="Requerimentos" class="a-asclasse"><i
                class="bi bi-file-earmark-text-fill"></i><span v-if="isExpanded">Requerimentos</span></Link>

            <Link :href="route('welcome')" title="Campus Virtual" class="logoAsclasse">
            <img src="../../../public/assets/img/portal.png" alt="Campus Virtual" class="logoAsclasseExpanded">
            </Link>
        </div>

        <div v-else class="anchors">
            <Link :href="route('users')" title="Usuários" class="a-asclasse"><i class="bi bi-people-fill"></i><span
                v-if="isExpanded">Usuários</span></Link>

            <Link :href="route('cursos')" title="Cursos" class="a-asclasse"><i class="bi bi-c-square-fill"></i><span
                v-if="isExpanded">Cursos</span></Link>

            <Link :href="route('disciplinas')" title="Disciplinas" class="a-asclasse"><i class="bi bi-book-half"></i><span
                v-if="isExpanded">Disciplinas</span></Link>

            <Link :href="route('turmas')" title="Turmas" class="a-asclasse"><i class="bi bi-easel2-fill"></i><span
                v-if="isExpanded">Turmas</span></Link>

            <Link :href="route('requerimentos')" title="Requerimentos" class="a-asclasse"><i
                class="bi bi-file-earmark-text-fill"></i><span v-if="isExpanded">Requerimentos</span></Link>

            <Link :href="route('welcome')" title="Campus Virtual" class="logoAsclasse">
            <img src="../../../public/assets/img/portal.png" alt="Campus Virtual" class="logoAsclasseExpanded">
            </Link>
        </div>
    </aside>
</template>

<style scoped>
aside {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 1rem;
    background-color: #3065ac;
    min-height: 100vh;
    width: calc(2rem + 68px);
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
    font-family: 'Inter', sans-serif;
    transition: ease-in-out 0.3s;

    &.isExpanded {
        width: 24%;
        align-items: start;
    }
}

.header-asclasse {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    line-height: 1;
    color: var(--white);
}

.perfil {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14pt;
}

.img-perfil {
    border-radius: 50%;
    width: 2.4rem;
    height: 2.4rem;
    overflow: hidden;
    position: relative;
}

.img-perfil img {
    position: absolute;
    bottom: 0;
    width: 100%;
}

.text-perfil {
    line-height: normal;
}

.tipo-text {
    color: #140D4F;
    font-weight: 700;
}

.h2-asclasse {
    color: #140D4F;
    font-size: 16pt;
    font-weight: 600;
}

.h3-asclasse {
    font-size: 20pt;
    font-weight: 700;
}

.anchorsExpanded {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    display: flex;
    align-items: start;
    font-size: 16pt;
    font-weight: 500;
}

.anchors {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    display: flex;
    align-items: center;
    font-size: 16pt;
    font-weight: 500;
}

.a-asclasse {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: var(--white);
    padding: 0.6rem 0.6rem;
    border-radius: 100%;
    transition: 0.3s;
    font-size: 18pt;
    font-weight: 600;

    span {
        transition: 0.2s;
    }

    i {
        border-radius: 100%;
    }
}

.logoAsclasse {
    width: 4rem;
    align-self: center;
}

.a-asclasse span:hover {
    letter-spacing: 2px;
}

.dropdown-toggle {
    color: white;
    font-size: 20pt;
    display: flex;
    justify-content: center;
}
</style>
