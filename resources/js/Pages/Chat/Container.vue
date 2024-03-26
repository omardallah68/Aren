<script setup>

import MessageContainer from "@/Pages/Chat/MessageContainer.vue";
import InputMessage from "@/Pages/Chat/InputMessage.vue";
import {onMounted, reactive, ref, watch} from "vue";
import ChatRoomSelection from "@/Pages/Chat/ChatRoomSelection.vue";
import Pusher from "pusher-js";
import Echo from "laravel-echo";
import DialogModal from "@/Components/DialogModal.vue";
import {includes} from "vue3-editor";

let chatRooms = ref([]);
let users = ref([]);
let currentRoom = ref([]);
let messages = ref([]);

Pusher.logToConsole = false;

watch(() => currentRoom.value, (value, oldValue) => {
    if (oldValue.id) {
        disconnect(oldValue);
    }
    connect();
});

const connect = () => {
    if (currentRoom.value.id) {
        getMessages();
        window.Echo.private("chat." + currentRoom.value.id)
            .listen('NewChatMessage', e => {
                getMessages();
            });
    };
};

const disconnect = (room) => {
    window.Echo.leave("chat." + room.id )
};

const getRooms = () => {
    axios.get('/chat/rooms')
        .then(response => {
            chatRooms.value = response.data
            setRoom(response.data[0])
        })
        .catch(error => {
            console.error(error);
        });
    axios.get('/chat/users')
        .then(response => {
            users.value = response.data
        })
        .catch(error => {
            console.error(error);
        });
};

const setRoom = (room) => {
    if (!chatRooms.value.includes(room))
    {
        axios.post('chat/new-room', { params: {'receiver': room} } )
            .then(response => {
                currentRoom.value = response.data
            })
            .catch(error => {
                console.error(error);
            });
    }
    currentRoom.value = room;
};

const getMessages = () => {
    axios.get('/chat/room/' + currentRoom.value.id + '/messages')
        .then(response => {
            messages.value = response.data
        })
        .catch(error => {
            console.error(error);
        });
};

onMounted(() => {
    getRooms();
});

const status = ref(false)
const open = () => {
    status.value = true;
};


const close = () => {
    status.value = false;
};

</script>

<template>
    <span>
        <span @click="open">
            <slot />
        </span>
        <DialogModal :show="status"
                     @close="close"
        >
                <template #title>
                <p class="flex flex-col items-center">Messenger</p>
                <ChatRoomSelection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :users="users"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"
                    class="w-full"
                />
            </template>

            <template #content>
                <MessageContainer
                    :messages="messages"
                    class="w-full h-[60vh]"
                />

                <InputMessage
                    :room="currentRoom"
                    v-on:messageSent="getMessages"
                    class="w-full"
                />
            </template>
            <template #footer>
            </template>
        </DialogModal>
    </span>
</template>

<style scoped>

</style>
