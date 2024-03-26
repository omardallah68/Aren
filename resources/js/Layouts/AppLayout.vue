<script setup>
import { Head } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import SideBar from "@/Layouts/SideBar.vue";
import { usePage } from '@inertiajs/vue3'
import {computed, watch, ref} from "vue";
import Container from "@/Pages/Chat/Container.vue";
import Cart from "@/Layouts/Cart.vue"

import favicon from './favicon-32x32.png'
import ScaleSpinner from "@/Components/ScaleSpinner.vue";
import {VueAwesomePaginate} from "vue-awesome-paginate";

const roles = ref([])

const page = usePage()
const show = ref(false)


const close = () => {
    page.props.flash.message = null
}

/*
page.props.flash.message = 'Hello, ' + page.props.auth.user.name
*/

const Year = ref(null)
const Month = ref(null)
const Day = ref(null)
const Hour = ref(null)
const Minutes = ref(null)
const Seconds = ref(null)

const expandSidebar = () => {
    const sidebar = document.getElementsByClassName('sidebar');
    sidebar[0].classList.toggle('w-[15vw]')
    isSidebarExpanded.value = !isSidebarExpanded.value
}

const isSidebarExpanded = ref(false)

setInterval(() => {
    Year.value = new Date(Date.now()).toLocaleString('default', {year: "numeric"})
    Month.value = new Date(Date.now()).toLocaleString('default', { month: 'short' })
    Day.value =   ( '0' + new Date(Date.now()).toLocaleString('default', { day: '2-digit' })).substr(-2)
    Hour.value =  ( '0' + new Date(Date.now()).toLocaleString('default', { hour: '2-digit' })).split('Uhr')[0].substr(-3)
    Minutes.value =  ( '0' + new Date(Date.now()).toLocaleString('default', { minute: '2-digit' })).substr(-2)
    Seconds.value =  ( '0' + new Date(Date.now()).toLocaleString('default', { second: '2-digit' })).substr(-2)
}, 1000)

</script>

<template>
    <div>
        <Head class="capitalize" :title="page.title || $page.url.split('/')[1].split('?')[0]">
            <link rel="icon" :href="favicon" />
        </Head>


        <Banner />

<!--        <div v-if="$page.props.flash.message" class="fixed flex z-auto text-black bg-yellow-500 max-w-md left-[70%] top-[12%]">
            <button class="p-5" @click="close">X</button>
            <p class="px-20 py-5 ml-5">{{ $page.props.flash.message }}</p>
        </div>-->

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <aside
                class="sidebar fixed flex flex-row h-[100vh] z-20 transition-all ease-in-out"
                :class="isSidebarExpanded ? 'w-[15vw]' : 'w-[4vw]'"

            >
                <SideBar :isSidebarExpanded="isSidebarExpanded" />
            </aside>

            <!-- Page Heading -->
            <header class="bg-gray-800/75 backdrop-blur-md z-10 fixed w-[100vw] max-h-32 flex items-center shadow">
                <div class="grid grid-cols-5 grid-rows-1 items-center p-2 w-full h-fit dark:text-white">
                    <slot name="header">
                        <el-button
                            :class="isSidebarExpanded ? 'ml-[16vw]' : 'ml-[5vw]'"
                            @click="expandSidebar"
                            circle
                            plain
                        >
                            <font-awesome-icon icon="fa-bars" />
                        </el-button>
                        <div class="flex flex-row justify-around items-center col-start-3 bg-gray-700/75 rounded">
                            <div class="flex flex-row items-center">
                                <div class="flex">
                                    <p class="text-lg font-bold rotate-180" style="writing-mode: vertical-lr; ">{{ Year }}</p>
                                </div>
                                <div class="flex flex-col items-start">
                                    <p class="text-lg font-bold">{{ Day }}</p>
                                    <p class="text-md font-bold">{{ Month }}</p>
                                </div>
                            </div>
                            <img :src="favicon" alt="" srcset="" class="w-[30px] h-[30px]">
                            <div class="flex flex-row items-center space-x-1 w-fit h-fit">
                                <div class="flex">
                                    <p class="text-4xl font-extrabold">{{ Hour }}</p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <p class="text-lg font-bold">{{ Minutes }}</p>
                                    <p class="text-sm" align="right">{{ Seconds }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-start-5 flex items-center capitalize gap-1 font-bold bg-gray-700/75 p-2 rounded w-fit">
                            <font-awesome-icon icon="fa-hand-peace" class="text-red-600"/>
                            <font-awesome-icon icon="fa-hand-peace" class="text-black"/>
                            <h3>{{ $page.url.split('/')[1].split('?')[0] }}</h3>
                            <font-awesome-icon icon="fa-hand-peace" class="text-white" style="transform: rotateY(180deg)"/>
                            <font-awesome-icon icon="fa-hand-peace" class="text-green-600" style="transform: rotateY(180deg)"/>
<!--                            <div class="flex flex-col gap-1.5">
                                <font-awesome-icon icon="fa-hand-peace" class="text-red-600 rotate-[145deg]"/>
                                <font-awesome-icon icon="fa-hand-peace" class="text-red-600 rotate-[10deg]"/>
                                <font-awesome-icon icon="fa-hand-peace" class="text-red-600 rotate-[55deg]"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <font-awesome-icon icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                <font-awesome-icon icon="fa-hand-peace" class="text-red-600 rotate-[100deg]"/>
                                <font-awesome-icon icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>

                            </div>
                            <div class="flex flex-col">
                                <div class="flex">
                                    <font-awesome-icon icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                    <font-awesome-icon icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                    <font-awesome-icon icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                    <font-awesome-icon v-if="$page.url.split('/')[1].split('?')[0].length > 5" icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                    <font-awesome-icon v-if="$page.url.split('/')[1].split('?')[0].length > 6" icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                    <font-awesome-icon v-if="$page.url.split('/')[1].split('?')[0].length > 8" icon="fa-hand-peace" class="text-black rotate-[10deg]"/>
                                </div>

                                <h3>{{ $page.url.split('/')[1].split('?')[0] }}</h3>


                                <div class="flex">
                                    <font-awesome-icon icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>
                                    <font-awesome-icon icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>
                                    <font-awesome-icon icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>
                                    <font-awesome-icon v-if="$page.url.split('/')[1].split('?')[0].length > 5" icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>
                                    <font-awesome-icon v-if="$page.url.split('/')[1].split('?')[0].length > 6" icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>
                                    <font-awesome-icon v-if="$page.url.split('/')[1].split('?')[0].length > 8" icon="fa-hand-peace" class="text-green-600 rotate-[190deg]"/>
                                </div>
                            </div>-->
                        </div>
                    </slot>
                </div>
                <Container
                        class="ml-2"
                >
                    <div class="flex flex-col items-end absolute right-0 -bottom-[80vh]">
                        <button
                                class="sticky text-black w-10 h-10 flex flex-row justify-around items-center bg-yellow-500 p-3 pr-3 rounded-l-full hover:w-32 group transition-all duration-500 ease-out"
                        >
                            <font-awesome-icon icon="fa-solid fa-comments" />
                            <span class="font-bold opacity-0 hidden group-hover:flex group-hover:opacity-100">Chat</span>
                        </button>
                    </div>
                </Container>

                <div class="flex flex-col items-end absolute right-0 top-5 select-none font-serif font-extrabold bg-red-600 text-white p-1 px-2 pr-4 rounded-l-full">
                    يا أم الشهيد نيالك ... يا ريت أمي بدالك
                </div>

                <Cart
                    class="ml-2"
                >
                    <div class="flex flex-col items-end absolute right-0 -bottom-[73vh]">
                        <button
                            class="sticky text-white whitespace-nowrap w-12 h-10 flex flex-row justify-around items-center bg-blue-500 p-3 pr-3 rounded-l-full hover:w-48 group transition-all duration-500 ease-out"
                        >
                            <font-awesome-icon icon="fa-solid fa-cart-shopping" />
                            <span class="font-bold opacity-0 hidden group-hover:flex group-hover:opacity-100">Shopping Cart</span>
                        </button>
                    </div>
                </Cart>
            </header>

            <!-- Page Content -->
            <main
                class="px-32 py-10 pt-32 transition-all ease-in-out"
                :class="isSidebarExpanded ? 'ml-[15vw]' : ''"
            >
                <slot />
                <ScaleSpinner/>
            </main>

            <footer>
            </footer>
        </div>
    </div>
</template>
<style scoped>

</style>
