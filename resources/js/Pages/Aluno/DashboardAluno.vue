<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
import Button from "@/Components/Button.vue";

defineProps({ user: Object });
</script>

<template>
  <header>
    <HeaderAluno :nome="user.name" />
  </header>

  <section>
    <Button title="Avisos" description="Veja os avisos mais recentes publicados pelos professores!" route="avisos"
      icon="bi bi-app-indicator" />

    <Button title="Disciplina" description="Veja as disciplinas do seu curso!" route="aluno.disciplinas"
      icon="bi bi-layout-text-window" />

    <Button title="Boletim" description="Notas e faltas do semestre aparecerão aqui!" route="aluno.boletim"
      icon="bi bi-receipt" />

    <Button title="Requerimentos" description="Faça seus requerimentos pro bloco administrativo!" route="requerimento.index"
      icon="bi bi-pencil-square" />

    <Button title="Registro" description="Seus registros estão aqui!" route="" icon="bi bi-check-square" />
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
