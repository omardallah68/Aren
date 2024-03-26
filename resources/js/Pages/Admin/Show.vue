<script setup>
import Users from "@/Pages/Admin/Users/Show.vue"
import Roles from "@/Pages/Admin/Roles/Show.vue"
import Permissions from "@/Pages/Admin/Permissions/Show.vue"
import Teams from "@/Pages/Admin/Teams/Show.vue"
import {Head} from '@inertiajs/vue3'
import Counter from "@/Components/Counter.vue";

defineProps({
    users: Object,
    roles: Object,
    permissions: Object,
    teams: Object
})

</script>
<template>
    <Head title="Admin" />
    <div class="flex flex-col text-white p-12">
        <slot>
            <section>
<!--                <div class="flex flex-row justify-between static">
                    <div class="flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Users</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ users.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-users" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Roles</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ roles.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-users-gear" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Permissions</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ permissions.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-key" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Teams</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ teams.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-people-group" class="text-black text-4xl"/>
                        </div>
                    </div>
                </div>-->

                <div class="grid grid-cols-5 grid-rows-12 gap-4">
                    <div class="col-start-1 row-start-1 flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Users</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ users.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-users" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="col-span-3 row-span-5 col-start-1 row-start-2 p-8 rounded-lg overflow-hidden bg-[#0466c8]/90">
                        <Users :users="users" :roles="roles"/>
                    </div>
                    <div class="col-start-1 row-start-7 flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Roles</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ roles.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-users-gear" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="col-span-3 row-span-5 col-start-1 row-start-8 p-8 rounded-lg overflow-hidden bg-[#0466c8]/90">
                        <Roles :roles="roles" :permissions="permissions"/>
                    </div>
                    <div class="col-start-4 row-start-1 flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Permissions</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ permissions.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-key" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="col-span-2 row-span-4 col-start-4 row-start-2 p-8 rounded-lg overflow-hidden bg-[#0466c8]/90">
                        <Permissions :permissions="permissions"/>
                    </div>
                    <div class="col-start-4 row-start-6 flex flex-col items-start p-5 bg-yellow-500 rounded-xl min-w-[10vw]">
                        <h1 class="flex text-xl mb-5 text-black">Teams</h1>
                        <div class="w-full flex flex-row justify-between">
                            <h1 class="flex font-extrabold text-4xl text-black">{{ teams.total }}</h1>
                            <font-awesome-icon icon="fa-solid fa-people-group" class="text-black text-4xl"/>
                        </div>
                    </div>
                    <div class="col-span-2 row-span-4 col-start-4 row-start-7 p-8 rounded-lg overflow-hidden bg-[#0466c8]/90">
                        <Teams :teams="teams"/>
                    </div>
                </div>

            </section>
        </slot>
    </div>
</template>
