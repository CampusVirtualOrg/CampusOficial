<script setup>
import HeaderAluno from "@/Components/HeaderAluno.vue";
defineProps({
	post: Object,
	id: String,
	comments: Object,
	user: Object
});

const formatDateAgo = (datetime) => {
        const currentDate = new Date();
		const postDate = new Date(datetime);
		const timeDifference = currentDate - postDate;
		const seconds = Math.floor(timeDifference / 1000);
		const minutes = Math.floor(seconds / 60);
		const hours = Math.floor(minutes / 60);

		if(hours < 24) {
			if(hours > 0) {
				return `há ${hours} ${hours > 1 ? 'horas' : 'hora' }`;
			} else if(minutes > 0) {
				return `há ${minutes} ${minutes > 1 ? 'minutos' : 'minuto' }`;
			} else if(seconds > 0) {
				return `há ${seconds} ${seconds > 1 ? 'segundos' : 'segundo' }`;
			}
		} else {
			return postDate.toLocaleString('pt-BR', { timeZone: 'America/Sao_Paulo' });
		}

    };
</script>

<template>
	<header>
		<HeaderAluno :nome="user.name" :imagem="user.imagem"></HeaderAluno>
	</header>
	<section>
		<a href="#" class="container-post" v-for="(item, i) in post" :key="i">
			<div class="text">
				<button hidden>{{ item['id'] }}</button>
				<div class="titles">
					<div class="lado1">
						<h1>{{ item.user.name }}</h1>
						<h2>{{ item.user.tipo }}</h2>
					</div>
					<h2>{{ formatDateAgo(item.created_at) }}</h2>
				</div>
				<p>{{ item["descr"] }}</p>
			</div>
		</a>

		<div class="comentar">
			<form action="/aviso/comment" method="post">
				<textarea maxlength="200" :placeholder="`Comente algo ${user.name}!`" name="comment" id="comment" />
				<input type="text" hidden :value="this.post[0].id" name="post" id="post" />
				<button class="btn" type="submit">Comentar</button>
			</form>
		</div>

		<div class="comentarios">
			<div class="comment-item" v-for="(comment, index) in comments" :key="index">
				<div class="commentIndividual">
					<div class="titlesComment">
						<div class="textsCom">
							<h1>{{ comment.user.name }}</h1>
							<h2>{{ comment.user.tipo }}</h2>
						</div>
						<h2>{{ formatDateAgo(comment.created_at) }}</h2>
					</div>
					<p>{{ comment.comment }}</p>
				</div>
			</div>
		</div>
	</section>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");

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
	justify-content: start;
	height: 100%;
	width: 80%;
	background-color: white;
	margin: 4rem;
	font-family: "Inter", sans-serif;
	gap: 0.4rem;
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
	flex-direction: column;
	justify-content: center;
	align-items: start;
	width: 60%;
	height: auto;
	background-color: #fff;
	border: 2px solid #dfdfdf;
	border-radius: 8px;
	padding: 1rem 2rem;
}

.text {
	width: 100%;
	display: flex;
	flex-direction: column;
	align-items: start;
	text-align: start;
	gap: 0.8rem;
}

.text h1 {
	font-size: 15pt;
	font-weight: 800;
	color: #3065ac;
}

.text h2 {
	font-size: 12pt;
	font-weight: 500;
	color: #555555;
}

.text p {
	font-size: 14pt;
	font-weight: 400;
	color: #252627;
}

.titles {
	display: flex;
	align-items: baseline;
	width: 100%;
	justify-content: space-between;
}

.lado1 {
	display: flex;
	flex-direction: column;
}

.actions {
	margin-top: 0.4rem;
}

.comment {
	color: #555555;
	font-size: 12pt;
}

.comentar {
	width: 60%;
	display: flex;
}

form {
	display: flex;
	width: 100%;
	align-items: center;
	justify-content: center;
}

form textarea {
	width: 100%;
	background-color: #fff;
	border: 2px solid #dfdfdf;
	border-radius: 8px 0px 0px 8px;
	resize: none;
}

form textarea:focus {
	border: 2px solid #3065ac;
	outline: none;
}

label {
	font-size: 16pt;
	color: #3065ac;
	font-weight: 700;
}

.btn {
	background-color: #3065ac;
	padding: 0.2rem 0.6rem;
	border-radius: 0px 8px 8px 0px;
	height: 100%;
	color: #fff;
	font-weight: 500;
	font-size: 14pt;
}

.comentarios {
	display: flex;
	flex-direction: column;
	width: 60%;
	background-color: #fff;
	border: 2px solid #dfdfdf;
	border-radius: 8px;
}

.commentIndividual {
	display: flex;
	flex-direction: column;
	background-color: #fff;
	border-bottom: 2px solid #dfdfdf;		
	padding: 1rem 2rem;
	gap: 0.8rem;
	width: 100%;
}
.commentIndividual p {
	color: #252627;
}
.titlesComment {
	display: flex;
	align-items: center;
	justify-content: space-between;
	width: 100%;
}

.titlesComment h2 {
	font-size: 11pt;
	font-weight: 600;
	color: #555555;
}
.textsCom {
	display: flex;
	align-items: center;
	gap: 0.4rem;
}
.textsCom h1 {
	color: #3065ac;
	font-weight: 700;
	font-size: 14pt;
}
.textsCom h2 {
	color: #555555;
	font-weight: 600;
	font-size: 12pt;
}
</style>