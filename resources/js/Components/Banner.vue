<script setup>
import {ref, watch, watchEffect} from 'vue';
import { usePage } from '@inertiajs/vue3';
import { ElNotification } from 'element-plus'


const show = ref(true);
const style = ref('success');
const message = ref('');

const close = ref(false)

watchEffect(async () => {
    /*style.value = usePage().props.flash.bannerStyle || 'success';
    message.value = usePage().props.flash.message || '';
    show.value = true;

    setTimeout(() => close.value = true , 4000)
    setTimeout(()=> usePage().props.flash = '' , 5000)
    close.value = false*/
    if(usePage().props.flash.message !== null){
        ElNotification({
            position: "bottom-right",
            message: usePage().props.flash.message,
            type: usePage().props.flash.type || 'success',
            duration: 5000,
        })
    }

});
</script>

<template>
<!--    <div>
        <div v-if="show && message" class="animate__animated animate__fadeInRightBig fixed w-[57.5%] z-[100] top-[10%] right-0 shadow-[0px_0px_10px_2px_#eab308] rounded-l-full" :class="{ 'bg-yellow-500 text-black': style == 'success', 'bg-red-500 text-white': style == 'danger', 'animate__fadeOutRightBig': close == true }">
            <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center min-w-0">
                        <span class="flex p-2 rounded-lg" :class="{ 'bg-yellow-400 text-black': style == 'success', 'bg-red-400 text-white': style == 'danger' }">
                            <svg v-if="style == 'success'" class="h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <svg v-if="style == 'danger'" class="h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </span>

                        <p class="ml-3 font-medium text-sm truncate">
                            {{ message }}
                        </p>
                    </div>

                    <div class="shrink-0 sm:ml-3">
                        <button
                            type="button"
                            class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition"
                            :class="{ 'hover:bg-yellow-600 focus:bg-yellow-600 text-black': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"
                            aria-label="Dismiss"
                            @click.prevent="show = false"
                        >
                            <svg class="h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

</template>
