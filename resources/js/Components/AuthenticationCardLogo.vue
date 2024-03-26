<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<script>
import imgLink from './Lion.png'
export default {
    props: {
        isSidebarExpanded: {
            type: Boolean,
            default: false
        }
    },
    data(){
        return{
            img: imgLink
        }
    }
}
</script>


<template>
    <Link :href="'/'">
        <div class="flex flex-col w-full items-start justify-between px-[1.5vw]">
            <div class="w-[150px] h-[150px] rounded-full rounded-tl-none rotate-45 bg-yellow-500">
<!--
                <img :src="img" alt="" class="z-10 -rotate-45">
-->
            </div>
            <h1
                class="text-white font-extrabold p-2 transition-all ease-in-out duration-300"
                :class="isSidebarExpanded ? 'opacity-100 flex' : 'opacity-0 hidden'"

            >
                Aren
            </h1>
        </div>
    </Link>
</template>
