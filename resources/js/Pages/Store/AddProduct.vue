<script setup>
import {ref, reactive, nextTick, toRef, watch} from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";

const emit = defineEmits();
const props = defineProps({
    title: {
        type: String,
        default: 'Add a new Product',
    },
    content: {
        type: String,
        default: 'Enter your Product name.',
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

const form = useForm({
    name: '',
    description: '',
    amount: '',
    shipping_costs: '',
    shipping_duration: '',
    price: '',
    processing: false,
});


const nameInput = ref(null);
const startCreating = () => {
    creating.value = true;
    setTimeout(() => nameInput.value.focus(), 250);

};

const create = () => {
    form.processing = true;
    axios.post(route('store.store'), {
        name: form.name,
        description: form.description,
        amount: form.amount,
        shipping_costs: form.shipping_costs,
        shipping_duration: form.shipping_duration,
        price: form.price,
    }).then((response) => {
        if (response.data.bannerStyle === 'success'){
            form.processing = false;
            closeModal();
            nextTick().then(() => emit('confirmed'));
        }

        if (page.props.flash === '') {
            page.props.flash = [];
        }
        page.props.flash.bannerStyle = response.data.bannerStyle
        page.props.flash.message = response.data.message
    }).catch(error => {
        form.processing = false;
        console.error(error)
        nameInput.value.focus();
    });
};

const closeModal = () => {
    creating.value = false;
    form.name = '';
    form.description = '';
    form.amount = '';
    form.shipping_costs = '';
    form.shipping_duration = '';
    form.price = '';
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
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
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
                        class="mt-1 block w-full"
                        placeholder="Description"
                    />

                    <InputError :message="form.error" class="mt-2" />
                </div>


                <div class="flex">
                    <div class="mt-4 w-full">
                        <p>Amount</p>
                        <TextInput
                            ref="nameInput"
                            v-model="form.amount"
                            type="text"
                            class="mt-1 block w-3/4"
                            placeholder="Amount"
                        />

                        <InputError :message="form.error" class="mt-2"/>
                    </div>

                    <div class="mt-4 w-full">
                        <p>Shipping costs</p>
                        <TextInput
                            ref="nameInput"
                            v-model="form.shipping_costs"
                            type="text"
                            class="mt-1 block w-3/4"
                            placeholder="Shipping costs"
                        />

                        <InputError :message="form.error" class="mt-2"/>
                    </div>
                </div>

                <div class="flex">
                    <div class="mt-4 w-full">
                        <p>Shipping duration</p>
                        <TextInput
                            ref="nameInput"
                            v-model="form.shipping_duration"
                            type="text"
                            class="mt-1 block w-3/4"
                            placeholder="Shipping duration"
                        />

                        <InputError :message="form.error" class="mt-2"/>
                    </div>

                    <div class="mt-4 w-full">
                        <p>Price</p>
                        <TextInput
                            ref="nameInput"
                            v-model="form.price"
                            type="text"
                            class="mt-1 block w-3/4"
                            placeholder="Price"
                            @keyup.enter="create"
                        />

                        <InputError :message="form.error" class="mt-2"/>
                    </div>
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
