<script setup>
import {ref, reactive, nextTick, toRef, watch} from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {usePage} from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";

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
    }
});



const creating = ref(false);

const form = reactive({
    title: '',
    description:'',
    start: '',
    end: '',
    is_all_day: false,
    processing: false,
});

watch(() => props.appointmentSelected, (newValue) => {
    if(newValue.length > 0) {
        return [
            form.start = props.appointmentSelected[0].split('+')[0],
            form.end = props.appointmentSelected[1].split('+')[0],
        ]
    }
});

const nameInput = ref(null);
const startCreating = () => {
    creating.value = true;
    setTimeout(() => nameInput.value.focus(), 250);

};

const create = () => {
    form.processing = true;

    axios.post(route('appointments.store'), {
        title: form.title,
        description: form.description,
        start: form.start,
        end: form.end,
        is_all_day: form.is_all_day,
    }).then((response) => {
        form.processing = false;
        emit('new-appointment',response.data)
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
    form.title = '';
    form.description = '';
    form.start = '';
    form.end = '';
    form.is_all_day = false;
};
</script>

<template>

    <span>
        <span @click="startCreating" >
            <slot />
        </span>

        <DialogModal :show="creating" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <p>Name</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-3/4"
                        :placeholder="placeholder"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <p>Description</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Description"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <p>Start</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.start"
                        type="datetime-local"
                        class="mt-1 block w-3/4"
                        placeholder="Start"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <p>End</p>
                    <TextInput
                        ref="nameInput"
                        v-model="form.end"
                        type="datetime-local"
                        class="mt-1 block w-3/4"
                        placeholder="End"
                        @keyup.enter="create"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <div class="flex items-center">
                        <Checkbox
                            v-model="form.is_all_day"
                            type="checkbox"
                            class="mr-1 block"
                            placeholder="All Day"
                            @keyup.enter="create"
                        />
                        <p>All Day</p>
                    </div>
                    <TextInput
                        ref="nameInput"
                        v-model="form.day"
                        type="date"
                        class="mt-1 block w-3/4"
                        placeholder="Day"
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
