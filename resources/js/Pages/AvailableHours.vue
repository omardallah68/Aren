<script setup>
import {ref, reactive, nextTick, toRef, watch} from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {usePage} from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropUp from "@/Components/DropUp.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const page = usePage()

const emit = defineEmits();
const props = defineProps({
    title: {
        type: String,
        default: 'Create',
    },
    content: {
        type: String,
        default: 'Enter your User new name.',
    },
    placeholder:{
        type: String,
        default: 'Name'
    },
    button: {
        type: String,
        default: 'Create',
    },
    appointmentSelected: {
        type: Object
    },
    availableHours: Array,
    sunday: Array,
    monday: Array,
    thursday: Array,
    wednesday: Array,
    tuesday: Array,
    friday: Array,
    saturday: Array,
});



const creating = ref(false);

const form = reactive({
    daysOfWeek: '',
    startTime:'',
    endTime: '',
    processing: false,
});

const nameInput = ref(null);
const startCreating = () => {
    creating.value = true;
    setTimeout(() => nameInput.value.focus(), 250);
};

const create = () => {
    form.processing = true;

    axios.post(route('business-hours.store'), {
        daysOfWeek: form.daysOfWeek,
        startTime: form.startTime,
        endTime: form.endTime,
    }).then((response) => {
        if (page.props.flash === '') {
            page.props.flash = [];
        }
        form.processing = false;
        page.props.flash.style = response.data.style
        page.props.flash.message = response.data.message
        emit('new-available-hours',response.data)
        closeModal();
        nextTick().then(() => emit('confirmed'));

    }).catch(error => {
        form.processing = false;
        console.error(error)
        form.error = error.response.data.errors.password[0];
        nameInput.value.focus();
    });
};

const closeModal = () => {
    creating.value = false;
    form.daysOfWeek = '';
    form.startTime = '';
    form.endTime = '';
};
</script>

<template>

    <span>
        <span @click="startCreating ">
            <slot />
        </span>

        <DialogModal :show="creating" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4 flex flex-row flex-wrap justify-around">
<!--                    <div v-for="d in props.availableHours" class="flex flex-row mx-5">
                        <p>{{ d.daysOfWeek.replaceAll('0', 'Sunday').replaceAll('1', 'Monday').replaceAll('2', 'Thursday').replaceAll('3', 'Wednesday').replaceAll('4', 'Tuesday').replaceAll('5', 'Friday').replaceAll('6', 'Saturday') }}</p>
                        <p class="pl-1">{{ d.startTime }}</p>
                        <p class="pl-1">-></p>
                        <p class="pl-1">{{ d.endTime }}</p>
                    </div>-->
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Sunday</label>
                        <div v-for="d in props.sunday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Monday</label>
                        <div v-for="d in props.monday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Thursday</label>
                        <div v-for="d in props.thursday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Wednesday</label>
                        <div v-for="d in props.wednesday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Tuesday</label>
                        <div v-for="d in props.tuesday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Friday</label>
                        <div v-for="d in props.friday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center min-w-[7vw] p-5">
                        <label class="mb-5">Saturday</label>
                        <div v-for="d in props.saturday" class="flex flex-row">
                            <p class="pl-1">{{ d.startTime }}</p>
                            <p class="pl-1">-></p>
                            <p class="pl-1">{{ d.endTime }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                  <!--  <p>Day</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.daysOfWeek"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Start"
                    />-->
                    <select
                        v-model="form.daysOfWeek"
                        class="mt-1 block w-3/4 bg-gray-900 text-white border-gray-700 rounded"
                    >
                        <option class="bg-gray-900" value="0">Sunday</option>
                        <option class="bg-gray-900" value="1">Monday</option>
                        <option class="bg-gray-900" value="2">Thursday</option>
                        <option class="bg-gray-900" value="3">Wednesday</option>
                        <option class="bg-gray-900" value="4">Tuesday</option>
                        <option class="bg-gray-900" value="5">Friday</option>
                        <option class="bg-gray-900" value="6">Saturday</option>
                    </select>
                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <p>Start</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.startTime"
                        type="time"
                        class="mt-1 block w-3/4"
                        placeholder="Start"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <p>End</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.endTime"
                        type="time"
                        class="mt-1 block w-3/4"
                        placeholder="End"
                        @keyup.enter="create"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="create"
                >
                    {{ button }}
                </PrimaryButton>
            </template>
        </DialogModal>
    </span>
</template>

<style scoped>
</style>
