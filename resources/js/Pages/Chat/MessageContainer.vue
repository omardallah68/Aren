<script setup>
import MessageItem from "@/Pages/Chat/MessageItem.vue";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    messages: Array
})
</script>

<template>
    <div class="h-96 w-full">
        <div class="h-full p-2 flex flex-col-reverse items-center overflow-y-scroll overflow-x-hidden">
            <div v-for="(message, index) in messages"
                 :key="index"
                 class="m-2 p-2 w-fit rounded-xl block max-w-[50%]"
                 :class="message.user_id === usePage().props.auth.user.id ? 'bg-yellow-500 mr-auto' : 'bg-blue-500 ml-auto'"
                 :title="message.created_at.replace('T', ' ').split('.')[0].replaceAll('-', '.')"
            >
                <MessageItem :message="message" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
