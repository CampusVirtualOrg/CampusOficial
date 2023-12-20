<script setup>
import HeaderAluno from '@/Components/HeaderAluno.vue';
import Button from '@/Components/Button.vue';

defineProps({ user: Object })
</script>

<template>
    <header>
        <HeaderAluno :nome="user.name"/>
    </header>

    <section>
        <Button
            title="Posts"
            description="Veja os posts da galera e publique também!"
            route="/avisos"
            icon="bi bi-app-indicator"
        />

        <Button
            title="Turmas"
            description="Suas turmas estão aqui!"
            route="professor/turmas"
            icon="bi bi-check-square"
        />

        <Button
            title="Requerimentos"
            description="Faça seus requerimentos pro bloco administrativo!"
            route="/requerimento/create"
            icon="bi bi-pencil-square"
        />

        <Button
            title="Chat"
            description="Entre no chat ap vivo e interaja com a galera!"
            route="/chat"
            icon="bi bi-chat-left-dots"
        />
    </section>

</template>

<style scoped>
header {
  display: flex;
  align-items: center;
  width: 100vw;
  justify-content: space-between;
  position: relative;
  top: 0;
  margin-top: 1rem;
}

section {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  margin-top: 1rem;
}
</style>
