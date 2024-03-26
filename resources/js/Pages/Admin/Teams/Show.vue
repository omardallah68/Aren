<script setup>
import Pagination from "@/Components/Pagination.vue";
import Counter from "@/Components/Counter.vue";

defineProps({
    teams: Object
})

</script>
<template>

    <div class="flex flex-col justify-between h-full w-full">
        <Counter name="teams" :count="teams.total"/>
        <div class="dark:text-white flex flex-col justify-around h-full">

            <!--    <div class="mb-2 text-white">
                    <NavLink :href="route('admin.permissions.create')"><i class="fa-solid fa-user-plus"></i>create a new permissions
                    </NavLink>
                </div>-->
            <div class="flex flex-col flex-wrap">
                <div v-for="team in teams.data" :key="team"
                     class="flex p-2 m-2 rounded capitalize backdrop-brightness-75 even:backdrop-brightness-90">
                    {{ team.name }}
                </div>
            </div>
            <Pagination :links="teams.links" class="mt-6"/>
        </div>
    </div>

</template>
