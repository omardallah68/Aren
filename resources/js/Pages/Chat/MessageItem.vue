<script setup>
import {usePage} from "@inertiajs/vue3";


const props = defineProps({
    message: Object
})

</script>

<template>
    <div
        class="text-sm"
        :class="message.user.id === usePage().props.auth.user.id ? 'hidden' : 'text-white'"
    >
        {{message.user.name}}:
    </div>

    <div
        class="font-bold p-2 rounded-xl"
        :class="message.user_id === usePage().props.auth.user.id ? 'text-black' : 'text-white'"
    >
        <span v-html="message.message"></span>
        <span class="block text-xs text-right m-2">
            <timeago v-if="new Date(message.created_at).setHours(new Date(message.created_at).getHours() + 1) >= Date.now()"
                     :datetime="message.created_at">
            </timeago>
            <span v-if="new Date(message.created_at).setHours(new Date(message.created_at).getHours() + 1) < Date.now()">
                {{message.created_at.replace('T', ' ').split('.')[0].replaceAll('-', '.')}}
            </span>
        </span>
    </div>
</template>

<style scoped>

</style>
