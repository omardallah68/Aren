<script setup>

import {onMounted, ref, watch} from "vue";
import Select from "@/Components/Select.vue";

const props = defineProps({
    rooms: Array,
    users: Array,
    currentRoom: Object
})

const emit = defineEmits([
    'roomChanged'
])

let selected = ref('');

onMounted( () => {
    selected.value = props.currentRoom
})

</script>

<template>
    <div class="grid grid-cols-3 grid-rows-1 items-center border-b-[2px] -mb-4">
        <div v-if="selected.chat_room != null" class="col-start-1 font-bold text-xl text-white">
            {{selected.chat_room.name}} Chat
        </div>
        <div class="col-start-3 flex items-center">
            <p>Groups: </p>
            <select
                v-model="selected.chat_room"
                @change="emit('roomChanged', selected)"
                class="w-full bg-transparent border-0 text-white focus:ring-0"
            >
                <optgroup class="bg-amber-900" label="Rooms">
                    <option
                        v-for="(room, index) in rooms"
                        :key="index"
                        :value="room"
                        class="bg-yellow-500 text-black hover:bg-black hover:text-yellow-500 selection:bg-red-500"
                    >
                        {{ room.name }}
                    </option>
                </optgroup>
                <optgroup class="bg-amber-900" label="Users">
                    <option
                        v-for="(user, index) in users"
                        :key="index"
                        :value="user"
                        class="bg-yellow-500 text-black hover:bg-black hover:text-yellow-500 selection:bg-red-500"
                    >
                        {{ user.name }}
                    </option>
                </optgroup>
            </select>
        </div>
    </div>
</template>

<style scoped>
</style>
