<script setup>
//import VueSpinner from "vue-spinner/src";
import {ref, watchEffect} from "vue";
import {usePage} from "@inertiajs/vue3";

const ScaleLoader = VueSpinner.ScaleLoader

const loading = ref(false);

const props = defineProps({
    loading: Boolean
})

watchEffect(async () => {
    loading.value = usePage().props.loading || false;
});

</script>

<template>
    <div v-if="loading" class="fixed w-full h-full bg-gray-800/80 top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%]">
        <scale-loader :loading="loading" color="#057af0" class="fixed top-[50%] left-[50%]"></scale-loader>
    </div>
</template>

<style scoped>

</style>
