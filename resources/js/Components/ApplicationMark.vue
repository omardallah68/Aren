<template>
    <div class="flex flex-row w-full items-start justify-start px-[1.5vw] h-[50px]">
<!--        <div class="w-[20px] h-[20px] rounded-full rounded-tl-none rotate-45 bg-yellow-500 overflow-hidden transition-all ease-in-out duration-300 group-hover/sidebar:w-[50px] group-hover/sidebar:h-[50px]">
&lt;!&ndash;
            <img :src="img" alt="" class="z-10 -rotate-45">
&ndash;&gt;
        </div>-->
        <font-awesome-icon
            icon="fa-hand-peace"
            class="text-yellow-500 overflow-hidden transition-all ease-in-out"
            :class="is_sidebar_expanded ? 'w-[40px] h-[40px]' : ''"
        />

        <button
            class="text-white font-extrabold p-2 overflow-hidden transition-all ease-in-out"
            :class="is_sidebar_expanded ? 'opacity-100 flex' : 'opacity-0 hidden'"
        >
            Aren
        </button>
    </div>
</template>
<script>
import imgLink from './Lion.png'
export default {
    props:{
        is_sidebar_expanded:{
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
