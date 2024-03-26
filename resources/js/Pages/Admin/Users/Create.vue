<script setup>
import { ref, reactive, nextTick } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {usePage} from "@inertiajs/vue3";

const emit = defineEmits(['confirmed']);

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
});

const creating = ref(false);

const form = reactive({
    name: '',
    email:'',
    password:'',
    processing: false,
});

const nameInput = ref(null);

const startCreating = () => {
    creating.value = true;
    setTimeout(() => nameInput.value.focus(), 250);

};

const create = () => {
    form.processing = true;

    axios.post(route('admin.users.store'), {
        name: form.name,
        email: form.email,
        password: form.password,
    }).then(() => {
        form.processing = false;

        closeModal();
        nextTick().then(() => emit('confirmed'));

    }).catch(error => {
        form.processing = false;
        form.error = error.response.data.errors.password[0];
        nameInput.value.focus();
    });
};

const closeModal = () => {
    creating.value = false;
    form.name = '';
    form.email = '';
    form.password = '';
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
                {{ content }}

                <div class="mt-4">
                    <TextInput
                        ref="nameInput"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-3/4"
                        :placeholder="placeholder"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <TextInput
                        ref="nameInput"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Email"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>

                <div class="mt-4">
                    <TextInput
                        ref="nameInput"
                        v-model="form.password"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
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

