<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";

defineProps({ user: Object });
</script>

<template>
  <header>
	<HeaderAluno :nome="user.name" />
  </header>

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
	width: 100%;
}
</style>
