<script setup>
    defineProps({
        name: String,
        count: Number
    })
</script>

<template>
    <div class="flex flex-row">
        <h1 class="text-4xl mb-4 capitalize">{{ name }}</h1>
        <div class="flex items-center justify-center w-6 h-6 ml-1 bg-red-500 rounded-full animate-bounce">
            <h5 class="text-xs p-2">{{ count }}</h5>
        </div>
    </div>
</template>

<style scoped>

</style>
