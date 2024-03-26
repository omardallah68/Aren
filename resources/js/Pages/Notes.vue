<script setup>
import {Head, useForm, usePage} from "@inertiajs/vue3";
import {onMounted, ref, watch} from 'vue'
import { VueEditor } from "vue3-editor";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const cards = ref([]);

const page = usePage()

const form = useForm({
    id: null,
    content: '',
});

const getNotes = () => {
    page.props.loading = true
    axios.get(route('notes.index'))
        .then((response) => {
            page.props.loading = false
            cards.value = response.data.cards

        })
}

const createNote = () => {
    if (form.id != null) {
        page.props.loading = true
        axios.put(route('notes.update', form.id), {
            content: form.content
        }).then((response) =>
        {
            if (response.data.bannerStyle === 'success'){
                page.props.loading = false
                getNotes()
            }

            if (page.props.flash === '') {
                page.props.flash = [];
            }
            page.props.flash.bannerStyle = response.data.bannerStyle
            page.props.flash.message = response.data.message
            form.id = null
            form.content = ''
        })
    }
    else {
        page.props.loading = true
        axios.post(route('notes.store'), {
            content: form.content,
            errorBag: 'createNote',
            preserveScroll: true,
        }).then((response) =>
        {
            if (response.data.bannerStyle === 'success'){
                page.props.loading = false
                getNotes()
            }

            if (page.props.flash === '') {
                page.props.flash = [];
            }
            page.props.flash.bannerStyle = response.data.bannerStyle
            page.props.flash.message = response.data.message
        })
    }

};

let currentTime = ref(new Date().getFullYear() + '.' + new Date().getMonth() + '.' + new Date().getDay() + ' ' + new Date().toLocaleTimeString())

function isInt(n){
    return Number(n) === n && n % 1 === 0;
}

const ScrollToTop = () => {
    window.scrollTo(0,0)
}

onMounted(() => {
    getNotes()
})

</script>
<template>
    <Head title="Notes" />

    <div class="flex justify-center mb-10">
        <div class="bg-green-400 p-10 overflow-hidden relative flex flex-col items-center w-fit">
            <!--
                        <textarea v-model="form.content" class="bg-black/10 text-black w-full h-[90%] border-none focus:border-none mt-10"></textarea>
            -->
            <vue-editor v-model="form.content" class="bg-gray-300 mt-5"></vue-editor>
            <button class="absolute font-extrabold text-4xl p-2 right-4 top-4" @click="createNote"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">+
            </button>
            <p class="absolute mt-2 py-1 px-2 top-5 font-extrabold rounded bg-black/75 text-white">{{ currentTime }}</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-10 justify-evenly">
        <div v-for="card in cards"
             class="relative flex flex-col justify-between p-10 overflow-y-auto"
             :class=" isInt(card.id/3+3)
             ?  'w-80 h-80 bg-blue-400 animate-waving hover:animate-none hover:rotate-0'
             : 'w-80 h-80 bg-red-500 odd:bg-yellow-400 animate-waving odd:animate-wavi hover:animate-none hover:rotate-0'"
        >
            <button
                v-if="$page.props.user_permissions.includes('update posts')"
                @click="ScrollToTop(); (form.content = card.content); (form.id = card.id);"
                class="absolute right-5 top-5"
            >
                <font-awesome-icon icon="fa-pen-to-square"></font-awesome-icon>
            </button>

            <vue-editor v-model="card.content" class="bg-gray-200 border-0" :editorOptions="{modules: {toolbar: false}, readOnly: true}"></vue-editor>

            <div class="flex justify-end">
                <div class="w-fit py-1 px-2 float-right font-extrabold rounded bg-black/75 text-white">
                    {{ card.created_at.replace('T', ' ').split('.')[0].replaceAll('-', '.') }}
                </div>
            </div>
        </div>
    </div>
</template>
<style>
blockquote{
    border-radius: 5px;
    border-left: 5px solid #f8ca15;
    padding: 5px;
    font-weight: bold;
    background-color: #057af0 !important;
    color: #f8ca15 !important;
}
h1, h2, h3, h4, h5, h6 {
    font-size: revert !important;
    font-weight: revert !important;
}
</style>
