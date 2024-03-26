<template>
    <div class="flex flex-col items-center">
        <div class="text-yellow-300 bg-gray-600 w-fit p-3 rounded">
            <select class="bg-gray-800 border-0" v-model="selectedUser">
                <option v-for="user in users" :value="user" :key="user.id">
                    {{ user.name }}
                </option>
            </select>
            <input
                class="bg-transparent border-0 mr-2 focus:ring-0"
                v-model="message"
                @keyup.enter="sendMessage"
            />
            <button @click="sendMessage">Send</button>
        </div>
        <div>
            <div class="bg-yellow-500 text-black p-2 w-[10vw] m-2 rounded-xl"
                 v-for="msg in messages"
                 :key="msg.id"
                 :class="msg.user.id === usePage().props.auth.user.id ? '-translate-x-[80%]' : 'translate-x-[80%]'"
            >
                <div class="text-xs flex space-x-1">
                    <span class="font-extrabold" :class="msg.receiver_id === usePage().props.auth.user.id ? 'flex' : 'hidden'"> from </span>
                    <span :class="msg.user.id === usePage().props.auth.user.id ? 'hidden' : 'flex'">{{ msg.user.name }}</span>
                    <span class="font-extrabold" :class="msg.receiver_id === usePage().props.auth.user.id ? 'hidden' : 'flex'"> to </span>
                    <span :class="msg.receiver_id === usePage().props.auth.user.id ? 'hidden' : 'flex'">{{ msg.receiver.name }}</span>
                </div>
                <div class="font-bold ml-2 mt-2 bg-yellow-400 p-2 rounded-xl">
                    {{ msg.content }}
                    <span class="block text-xs text-right m-2">{{
                            msg.created_at.replace('T', ' ').split('.')[0].replaceAll('-', '.')
                        }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import Echo from 'laravel-echo';
import Pusher from "pusher-js";
import { usePage } from '@inertiajs/vue3';
import {onMounted, ref} from 'vue'

Pusher.logToConsole = true;

const message = ref('');
const selectedUser = ref(null);

const props = defineProps({
    messages: Array,
    users: Array
})
const sendMessage = () => {
    axios.post('/chat/send-message', {
            receiver_id: selectedUser.value.id,
            content: message.value,
        })
        .then((response) => {
            props.messages.unshift({
                user: response.data.user,
                receiver: response.data.receiver,
                content: response.data.content,
                created_at: response.data.created_at,
            });
        })
        .catch((error) => {
            console.error(error);
        });

    message.value = '';
};

const fetchMessages = () => {
    axios.get('/messages').then(response => {
        this.messages = response.data;
    });
};

onMounted(() => {
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        encrypted: true,
    });

    window.Echo.channel(`private-chat.${usePage().props.auth.user.id}`).listen('PrivateMessage', (data) => {
        props.messages.push({
            content: data.message,
            receiver_id: data.receiver_id,
        });
    });
});
</script>
