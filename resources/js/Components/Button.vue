<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    title: String,
    description: String,
    route: String,
    icon: String,
});

</script>

<template>
    <button class="button-section">
        <i :class="icon"></i>
        <Link :href="route">
        <p class="text-slate-700">
            <span class="title">
                {{ title }}
            </span>
            <span class="description">
                {{ description }}
            </span>
        </p>
        </Link>
    </button>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
.button-section {
    font-family: 'Inter', sans-serif;
    display: flex;
    align-items: center;
    width: 55%;
    padding: 0.8rem;
    cursor: pointer;
    border-radius: 12px;
    border: none;
    border: 2px #dfdfdf solid;
    background-color: #f9f9f9;
}

.button-section:hover {
    background-color: #e9e9e9;
}
.button-section:focus {
    background-color: #e9e9e9;
}

p {
    display: flex;
    flex-direction: column;
    align-items: start;
    margin-left: 10px;
}

.description {
    font-size: 16px;
    font-weight: 500;
    text-align: start;
}

.title {
    color: #3065ac;
    font-size: 25px;
    font-weight: 700;
}

i {
    font-size: 40px;
    color: #3065ac;
}

@media screen and (max-width: 672px) {
	.button-section {
        width: 80%;
        padding: 0.8rem;
    }

    .description {
        font-size: 16px;
    }
    
    .title {
        color: #3065ac;
        font-size: 25px;
        font-weight: 700;
    }
    
    i {
        font-size: 40px;
        color: #3065ac;
    }
}

@media screen and (max-width: 380px) {
    .description {
        font-size: 14px;
    }
    
    .title {
        color: #3065ac;
        font-size: 18px;
        font-weight: 700;
    }
    
    i {
        font-size: 36px;
        color: #3065ac;
    }
}
</style>

