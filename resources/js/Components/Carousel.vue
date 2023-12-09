<script setup>
</script>

<template>
    <div class="carrosel">
    </div>
</template>

<style>
    .carrosel {
        width: 38rem;
        height: 24rem;
        background-color: rgba(135, 135, 135, 0.56);
        border-radius: 30% 70% 66% 34% / 30% 26% 74% 70%
    }

    @media screen and (max-width: 916px) {
        .carrosel {
          width: 18rem;
          height: 28rem;
          margin-bottom: 2rem;
        }
      }

    @media screen and (max-width: 572px) {
        .carrosel {
          width: 16rem;
          height: 16rem;
        }
      }
</style>
