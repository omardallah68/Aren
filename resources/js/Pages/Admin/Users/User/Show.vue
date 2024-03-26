<script setup>
import Show from "@/Pages/Admin/Show.vue"
import {Link, useForm, Head} from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


defineProps({
    user: Object,
    roles: Array,
    teams: Array
})


const form = useForm({
    name: '',
    team_id: ''
});

const addRoleToUser = (user) => {
    form.patch(route('admin.users.update',user), {
        errorBag: 'addRoleToUser',
        preserveScroll: true,
    });
};


</script>
<script>
export default {
computed: {
    console: () => console,
    window: () => window,
}
}
</script>
<template>
    <Head title="User" />
    <Show :title="user.name">


        <div class="mb-20">
            <p class="px-6 py-2 my-2 bg-gray-600 rounded-md">{{ user.name }}</p>
            <Link :href="route('admin.roles.show',[role])" class="px-6 py-2 my-2 mx-6" v-for="role in user.roles">{{role.name}}</Link>
        </div>
<!--
            <button class="bg-white p-2 text-black" @click="console.log(roles)">user</button>
-->


        <FormSection @submitted="addRoleToUser(user)">
            <template #title>
                Add Role to User
            </template>

            <template #description>
                Add a new Role to User.
            </template>

            <template #form>
                <div class="col-span-6">
                    <InputLabel value="Role" />

                    <div class="flex items-center mt-2">
                        <div class="ml-4 leading-tight">
                            <select v-model="form.name" class="bg-gray-300 text-gray-900">
                                <option v-for="role in roles"
                                        :id="role.id"
                                        :value="role.name"
                                        type="text"
                                        class="block w-full mt-1"
                                        autofocus
                                >
                                    {{ role.name }}
                                </option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <InputLabel value="Team" />

                    <div class="flex items-center mt-2">
                        <div class="ml-4 leading-tight">
                            <select v-model="form.team_id" class="bg-gray-300 text-gray-900">
                                <option v-for="team in teams"
                                        :id="team.id"
                                        :value="team.id"
                                        type="text"
                                        class="block w-full mt-1"
                                        autofocus
                                >
                                    {{ team.name }}
                                </option>
                            </select>

                        </div>
                    </div>
                </div>

            </template>

            <template #actions>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add Role to User
                </PrimaryButton>
            </template>
            </FormSection>

    </Show>
</template>
