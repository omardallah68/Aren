<script setup>
import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue';
import { Head } from '@inertiajs/vue3'

defineProps({
    tokens: Array,
    availablePermissions: Array,
    defaultPermissions: Array,
});
</script>

<template>
    <Head title="API Tokens" />
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ApiTokenManager
                :tokens="tokens"
                :available-permissions="availablePermissions"
                :default-permissions="defaultPermissions"
            />
        </div>
    </div>
</template>
