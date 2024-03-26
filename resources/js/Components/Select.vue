<script setup>
import {reactive, watch} from "vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage()

const props= defineProps({
    options: Object,
    variable: Object,
    postRoute: String
})

const form = reactive({
    name: '',
});

const add = (variable) => {
    axios.put(route(props.postRoute, variable.id), {
        name: form.name,
    }).then((response) => {
        form.name = ''
        page.props.flash.message = response.data.message
    });
};

</script>

<template>
    <select v-model="form.name"
            @change="add(variable)"
            class="add bg-transparent text-sm rounded text-white"
    >
        <option v-for="option in props.options"
                :id="option.id"
                :value="option.name"
                type="text"
                class="block w-full mt-1 bg-blue-400"
        >
            {{ option.name }}
        </option>
    </select>
</template>

<style scoped>
select{
    background-image: none;

}
</style>
