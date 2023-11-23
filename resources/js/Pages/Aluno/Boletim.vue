<script setup>

defineProps({ user: Object, users: Object })
</script>

<template>
	<h1>Boletim </h1>

	<table class="styled-table">
                    <thead>
						<tr>
							<th>Nome</th>
							<th>{{ user.name }}</th>
						</tr>
						<tr>
							<th>Curso</th>
							<th></th>
						</tr>
                        <tr>
                            <th>Turma</th>
                        </tr>
                    </thead>
                    <tbody v-for="usuario in users">
                        <tr>
                            <td>{{ user.name }}</td>
                        </tr>
                    </tbody>
                </table>

</template>

<style scoped>
table {
    width: 100%;
    border: 1px solid #000;
    border-collapse: collapse;
}

tr,
td,
th {
    border: 1px solid black;
    text-align: center;
    padding: 0.4rem;
}

th {
    padding: 0.6rem;
    background-color: #3065ac;
    color: #ffffff;
    font-size: 14pt;
}
</style>
