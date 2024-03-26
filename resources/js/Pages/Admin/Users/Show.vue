<script setup>
import Pagination from "@/Components/Pagination.vue";
import Counter from "@/Components/Counter.vue";
import Create from "./Create.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3"
import {reactive, ref} from "vue";
import Select from "@/Components/Select.vue";

const page = usePage()

const props = defineProps({
    users: Object,
    roles: Object
})

const showModal = ref(false)

const willDelete = ref(false)

const removeRoleFromUser = (user, role) =>{
    axios.delete(route('admin.users.removeRoleFromUser',{userId: user.id, roleId: role.id}))
        .then(response => {
            page.props.flash.message = response.data.message
        })
}

</script>
<script>

export default {
    computed: {
        console: () => console,
        window: () => window,
    },

}
</script>
<template>
    <div class="flex flex-col justify-between h-full w-full">
        <Counter name="users" :count="users.total"/>
        <div class="mb-10 text-white">
            <Create
                @confirmed="showModal"
                create-route="admin.users.store"
                title="Create User"
                content="Enter your new User name"
                placeholder="User name"
            >
                <PrimaryButton type="button">
                    Create a new User
                </PrimaryButton>
            </Create>
        </div>
        <div class="dark:text-white flex flex-col justify-around">
            <table class="w-full">
                <thead>
                <tr class="h-[5vh] border-b-2">
                    <th align="left" class="w-[20%]">
                        <p class="ml-4">User</p>
                    </th>
                    <th class="w-[80%]">
                        Roles
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="user in props.users.data" :key="user.id"
                    class="border-b-[.1px] border-gray-400 even:backdrop-brightness-90">
                    <td align="left">
                        <p class="ml-2">{{ user.name }}</p>
                    </td>
                    <td align="right" class="flex flex-row flex-wrap items-center justify-end">
                        <div v-for="role in user.roles"
                             :class="role.name === 'Super-Admin'
                           ?'bg-red-500 px-4 py-2 m-1 text-sm font-bold rounded-sm drop-shadow-sm text-black'
                           : 'px-4 py-2 m-1 text-sm font-bold rounded-sm drop-shadow-sm text-black bg-yellow-500 even:bg-[#38b000] even:text-white'"
                             class="group grow-0 flex flex-row justify-between hover:grow-[0.01] transition-all ease-in-out duration-150"
                        >
                            <Link class="flex whitespace-nowrap capitalize" :href="route('admin.roles.show',role)">
                                {{ role.name }}
                            </Link>
                            <p class="hidden group-hover:flex mx-1 transition-all ease-in-out duration-150"> | </p>
                            <button class="hidden group-hover:flex transition-all ease-in-out duration-150"
                                    @click="removeRoleFromUser(user, role)"
                            >
                                x
                            </button>
                        </div>
                        <Select :options="props.roles.data" :variable="user" post-route="admin.users.update"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="users.links" class="mt-6"/>
    </div>
</template>

<style scoped>
</style>
