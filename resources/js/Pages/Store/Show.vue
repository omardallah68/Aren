<script setup>
import {Head, usePage} from "@inertiajs/vue3";
import {onMounted, ref} from 'vue'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AddProduct from "@/Pages/Store/AddProduct.vue";

const page = usePage()

const emit = defineEmits([])

const products = ref([])

const showModal = ref(false)

function isInt(n){
    return Number(n) === n && n % 1 === 0;
}

const buyProduct = (product) => {
    page.props.loading = true
    axios.post(route('store.buy', product.id))
        .then((response) => {
            page.props.loading = false
        })
}

const addProductToCart = (product) => {
    page.props.loading = true
    axios.post(route('cart.addItem', product.id))
        .then((response) => {
            console.log(response.data.message)
            response.data.message = page.props.flash.message
            emit('ProductAddedToCart', )
            page.props.loading = false
        })
}

const getProducts = () => {
    page.props.loading = true
    axios.get(route('store.index'))
        .then((response) => {
            setTimeout(()=>{
                page.props.loading = false
                products.value = response.data.products
            }, 2000)
        })
}

onMounted(() => {
    getProducts()
})

</script>
<template>
    <Head title="Store" />
    <AddProduct
        @confirmed="showModal; getProducts();"
    >
        <PrimaryButton type="button" id="button" class="mb-10">
            Add a new Product
        </PrimaryButton>
    </AddProduct>
    <div class="flex flex-wrap gap-x-4 gap-y-20 justify-evenly">
        <div v-for="product in products"
             class="relative flex flex-col justify-between overflow-y-auto rounded-xl group"
             :class=" isInt(product.id/3+3)
             ? 'w-80 h-80 bg-gradient-to-b from-sky-500 to-indigo-500'
             : 'w-80 h-80 bg-gradient-to-b from-pink-500 to-purple-500 odd:from-blue-500 odd:to-green-500'"
        >
<!--            :title="'Description: ' + product.description + '\n' +
            'Amount: ' + product.amount + '\n' +
            'Shipping costs: ' + product.shipping_costs + '\n' +
            'Shipping duration: ' + product.shipping_duration + '\n'"-->
            <div class="flex overflow-hidden rounded-lg group-hover:hidden">
                <img :src="'https://picsum.photos/id/'+product.id*2+'/200/300'"
                     alt=""
                    class="h-full w-full object-cover opacity-80 group-hover:opacity-100"/>
            </div>

            <div class="flex group-hover:flex-col group-hover:items-center group-hover:flex-1 justify-around my-5">
                <span class="text-2xl font-extrabold">{{ product.name }}</span>
                <span class="text-sm font-extrabold hidden opacity-0 group-hover:opacity-100 group-hover:block">{{product.description}}</span>
                <span class="text-sm font-extrabold hidden opacity-0 group-hover:opacity-100 group-hover:block">{{product.amount}} Stock</span>
                <span class="text-md font-extrabold hidden opacity-0 group-hover:opacity-100 group-hover:block">Shipping costs are {{product.shipping_costs}}€</span>
                <span class="text-md font-extrabold hidden opacity-0 group-hover:opacity-100 group-hover:block">delivered in {{product.shipping_duration}}</span>
                <span class="text-lg font-extrabold">{{ product.price }}€</span>
            </div>

            <div class="flex justify-center w-full p-2 gap-5">
                <button class="border-2 border-sky-950 text-sky-950 hover:bg-blue-500 hover:text-white hover:border-white w-fit p-2" @click="addProductToCart(product)">Add to Cart</button>
                <button class="border-2 border-sky-950 text-sky-950 hover:bg-yellow-500 w-fit p-2" @click="buyProduct(product)">Buy now</button>
            </div>

        </div>
    </div>
</template>
