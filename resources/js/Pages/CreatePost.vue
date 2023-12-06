<script>
export default {
	data() {
		return {
			formData: {
				titulo: "",
				subtitulo: "",
				descr: "",
				url: "nothing for while...",
			},
			csrfToken: "",
		};
	},
	mounted() {
		// Recupere o token CSRF do cabeçalho da página
		this.csrfToken = document.head.querySelector(
			'meta[name="csrf-token"]'
		).content;
	},
	methods: {
		handleSubmit() {
			fetch("/aviso/create", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"X-CSRF-TOKEN": this.csrfToken,
				},
				body: JSON.stringify(this.formData),
			})
				.then((response) => response.json())
				.then((data) => {
					console.log(data);
					// Adicione lógica adicional aqui conforme necessário
				})
				.catch((error) => {
					console.error("Erro ao enviar dados:", error);
				});
		},
	},
};
</script>

<template>
	<div class="main">
		<form action="http://127.0.0.1:8000/aviso/create" method="post">
			<!-- Inclua o token CSRF -->
			<input type="hidden" name="_token" :value="csrfToken" />

			<div class="inputs">
				<label for="titulo">Título:</label>
				<input v-model="formData.titulo" type="text" id="titulo" name="titulo" required />
			</div>

			<div class="inputs">

				<label for="subtitulo">Subtítulo:</label>
				<input v-model="formData.subtitulo" type="text" id="subtitulo" name="subtitulo" required />
			</div>

			<div class="inputs">

				<label for="descr">Descrição:</label>
				<textarea v-model="formData.descr" id="descr" name="descr" required></textarea>
			</div>

			<!-- <div class="inputs">

				<label for="url">Imagem:</label>
				<input v-model="formData.url" type="text" id="url" name="url" />
			</div> -->

			<button type="submit">Enviar</button>
		</form>
	</div>
</template>

<style scoped>
.main {
	display: flex;
	align-items: center;
	justify-content: center;
}

form {
	display: flex;
	flex-direction: column;
	gap: 1rem;
	width: 20rem;
	margin-top: 8rem;
}

.inputs {
	display: flex;
	flex-direction: column;
}

button {
	background-color: #3065ac;
	padding: 0.2rem 0.6rem;
	border-radius: 20px;
	color: #fff;
	font-weight: 700;
	font-size: 16pt;
}
</style>
