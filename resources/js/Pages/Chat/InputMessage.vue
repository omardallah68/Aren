<script setup>
/*

import emailjs from '@emailjs/browser';

const sendEmail = () => {
    emailjs.init("ZLg0dQ2tV8YISYyOq");
    emailjs.sendForm('service_2w7pgps', 'template_3osamv4', this.$refs.form, "ZLg0dQ2tV8YISYyOq")
        .then((result) => {
            console.log('SUCCESS!', result.text);
        }, (error) => {
            console.log('FAILED...', error.text);
        });
}
*/

import {ref} from "vue";

const props = defineProps({
    room: Object
})

const emit = defineEmits([
    'messageSent'
])

let message = ref('');

const sendMessage = () => {
    if(message.value === '') {
        return;
    }

    axios.post('/chat/room/' + props.room.id + '/message', {
        message: message.value
    })
    .then(response => {
        if(response.status === 201) {
            message.value = '';
            emit('messageSent');
        }
    })
    .catch(error => {
        console.error(error);
    });
};

</script>
<template>
    <div class="">
        <div class="border-t-1 border-yellow-500 ">
            <input type="text"
                   v-model="message" @keyup.enter="sendMessage()"
                   placeholder="your Message..."
                   class="col-span-5 focus:ring-0 p-5 rounded-xl bg-gray-700 border-0 text-white"
            />
            <button @click="sendMessage()"
                    class="place-self-end bg-gray-500 hover:bg-blue-700 p-2 rounded-xl text-white w-[90%]"
            >
                Send
            </button>
<!--
            <form ref="form" @submit.prevent="sendEmail">
                <label>Name</label>
                <input type="text" name="to_name">
                <label>Email</label>
                <input type="email" name="email">
                <label>Message</label>
                <textarea name="message"></textarea>
                <input type="submit" value="Send">
            </form>-->

        </div>
    </div>
</template>

<style scoped>

</style>
