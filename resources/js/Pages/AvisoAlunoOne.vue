<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
defineProps({
	post: Object,
	id: String,
	comments: Object,
	user: Object
});
</script>

<template>
	<header></header>
	<section>
		<div class="container-post" v-for="(item, i) in post" :key="i">
			<div class="imagem">
				<img :src="'/assets/img/' + item['url']" alt="img" />
			</div>
			<div class="text">
				<button hidden>{{ item["id"] }}</button>
				<h1>{{ item["titulo"] }}</h1>
				<h2>{{ item["subtitulo"] }}</h2>
				<p>{{ item["descr"] }}</p>
			</div>
			<a class="anchors" :href="'editar/' + item['id']">Editar</a>
			<a class="anchors" :href="'remove/' + item['id']">Deletar</a>
		</div>

		<div class="comentar">
			<form action="/aviso/comment" method="post">
				<div class="inputs">
					<label for="comment">Deixe seu comentário!</label>
					<input
						type="text"
						placeholder="insira aqui seu comentario"
						name="comment"
						id="comment"
					/>
					<input
						type="text"
						hidden
						:value="this.post[0].id"
						name="post"
						id="post"
					/>
				</div>
				<button class="btn" type="submit">Comentar</button>
			</form>
		</div>
	</section>
	<div class="comentarios">
		<div
			class="comment-item"
			v-for="(comment, index) in comments"
			:key="index"
		>
			<p>{{ comment["comment"] }}</p>
		</div>
	</div>
</template>

<style scoped>
.comentarios p {
	background-color: #fff;
	border: 2px solid #dfdfdf;
	border-radius: 8px;
	padding: 1rem 2rem;
	width: fit-content;
}
.comentar {
	display: flex;
}

.inputs {
	display: flex;
	flex-direction: column;
	gap: 0.4rem;
}

form {
	display: flex;
	flex-direction: column;
	gap: 1rem;
}

input {
	width: 15rem;
}

label {
	font-size: 16pt;
	color: #3065ac;
	font-weight: 700;
}

.btn {
	background-color: #3065ac;
	padding: 0.2rem 0.6rem;
	border-radius: 20px;
	color: #fff;
	font-weight: 500;
	font-size: 14pt;
}

section {
	display: flex;
	flex-direction: row;
	flex-wrap: wrap;
	align-items: center;
	justify-content: space-evenly;
	height: 100%;
	width: 80%;
	background-color: white;
	margin: 4rem;
	@import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");
	font-family: "Inter", sans-serif;
}

.anchors {
	height: 100%;
	display: flex;
	align-self: baseline;
	margin-top: 25%;
	margin-right: 0.6rem;
	color: #3065ac;
	font-weight: bold;
}
.container-post {
	display: flex;
	justify-content: center;
	align-items: start;
	width: 60%;
	height: auto;
	background-color: #fff;
	border: 2px solid #dfdfdf;
	border-radius: 8px;
	padding: 1rem 2rem;
}

.imagem img {
	max-width: 80%;
	max-height: 100%;
}

.text {
	display: flex;
	flex-direction: column;
	align-items: start;
	text-align: start;
}

.text h1 {
	font-size: 18pt;
	font-weight: 800;
	color: #3065ac;
}

.text h2 {
	font-size: 14pt;
	font-weight: 500;
	color: #252627;
}

.text p {
	font-size: 12pt;
	font-weight: 400;
	color: 252627;
}
.comentarios {
	display: flex;
	flex-direction: column;
	width: 300px;
	gap: 20px;
	margin-left: 11.5rem;
	background-color: #fff;
	border: 2px solid #dfdfdf;
	border-radius: 8px;
	padding: 1rem 2rem;
	width: 40%;
}

/* a {
  color: black;
  text-decoration: underline;
  text-transform: uppercase;
}
h1 {
  font-size: 40px;
  font-weight: 800;
}
h2 {
  font-size: 30px;
  font-weight: 200;
}
p {
  font-size: 20px;
}
.text {
  display: flex;
  flex-direction: column;
}

.container-post {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 10px;
  width: 100%;
} */
</style>
