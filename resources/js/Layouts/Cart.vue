<script setup>

import DialogModal from "@/Components/DialogModal.vue";
import {getCurrentInstance, onMounted, ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router, usePage} from "@inertiajs/vue3";

const page = usePage()

const status = ref(false)
const open = () => {
    status.value = true;
};

const close = () => {
    status.value = false;
};

const items = ref([])

const getCartItems = () => {
    axios.get('cart')
        .then(response => {
            items.value = response.data
        })
        .catch(error => {
            console.error(error);
        });
}


const print = (product) => {
    page.props.loading = true
    axios.post(route('cart.print'))
        .then((response) => {
            page.props.loading = false
        })
}

/*page.props.on('ProductAddedToCart', () => {
    getCartItems()
})*/

watch(() => page.props, (newValue) => {
    console.log(newValue)
});

onMounted(() => {
    getCartItems()
    router.on('ProductAddedToCart', () => {
        getCartItems()
    })
})



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
                <p class="flex flex-col items-center">Shopping Cart</p>

            </template>

            <template #content>

                <table class="w-full text-lg">
                    <tr class="border-b-[.1px]">
                        <th class="pb-2">Title</th>
                        <th class="pb-2">Quantity</th>
                        <th class="pb-2">Price</th>
                    </tr>
                    <tr v-for="item in items" class="text-center odd:bg-gray-500/25">
                        <td>{{ item.title }}</td>
                        <td>{{ item.quantity }}</td>
                        <td>{{ item.price }}</td>
                    </tr>
                </table>


            </template>
            <template #footer>
                <PrimaryButton @click="print()">Print</PrimaryButton>
            </template>
        </DialogModal>
    </span>
</template>

<style scoped>

</style>
