<script setup>
import Pagination from '@/Components/Pagination.vue'
import Counter from "@/Components/Counter.vue";
import Create from "@/Pages/Admin/Create.vue";
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from 'vue'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Select from "@/Components/Select.vue";

const props = defineProps({
    roles: Object,
    permissions: Object
})

const page = usePage()

const showModal = ref(false)


const removePermissionFromRole = (role, permission) =>{
    axios.delete(route('admin.roles.removePermissionFromRole',{roleId: role.id, permissionId: permission.id}))
        .then(response => {
            page.props.flash.message = response.data.message
        })
}


</script>
<template>
    <div class="flex flex-col justify-between h-full w-full">
        <Counter name="roles" :count="props.roles.total"/>
        <div class="mb-2 text-white">
            <Create
                @confirmed="showModal"
                create-route="admin.roles.store"
                title="Create Role"
                content="Enter your new Role name"
                placeholder="Role name"
            >
                <PrimaryButton type="button">
                    Create a new Role
                </PrimaryButton>
            </Create>
        </div>
        <div class="dark:text-white flex flex-col justify-around h-full">
            <table class="w-full">
                <thead>
                <tr class="h-[5vh] border-b-2">
                    <th align="left" class="w-[20%]">
                        <p class="ml-4">Role</p>
                    </th>
                    <th class="w-[80%]">
                        Permissions
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="role in props.roles.data" :key="role.id"
                    class="border-b-[.1px] border-gray-400 even:backdrop-brightness-90">
                    <td align="left">
                        <p class="ml-2">{{ role.name }}</p>
                    </td>
                    <td align="center" class="flex flex-row flex-wrap justify-end">
                        <div v-for="permission in role.permissions"
                           :class="permission.name === 'delete posts'
                           ?'bg-red-700 text-white px-4 py-2 m-1 text-sm capitalize font-bold rounded-sm'
                           :'px-4 py-2 m-1 text-sm capitalize font-bold rounded-sm drop-shadow-sm bg-gray-900 even:bg-yellow-500 even:text-black' "
                           class="group grow-0 flex flex-row justify-between hover:grow-[0.02] transition-all ease-in-out duration-150"
                        >
                            <p class="flex whitespace-nowrap capitalize">{{ permission.name }}</p>
                            <p class="hidden group-hover:flex mx-1 transition-all ease-in-out duration-150"> | </p>
                            <button class="hidden group-hover:flex transition-all ease-in-out duration-150" @click="removePermissionFromRole(role, permission)">x</button>
                        </div>
                        <Select :options="props.permissions.data" :variable="role" post-route="admin.roles.update"/>
                    </td>
                </tr>
                </tbody>
            </table>

            <Pagination :links="props.roles.links" class="mt-6"/>
        </div>
    </div>
</template>

<style scoped>
</style>
