<script setup>
import Show from "@/Pages/Admin/Show.vue"
import {useForm} from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    role:Object,
    permissions:Array
})


const form = useForm({
    name: '',
});

const addPermissionToRole = (role) => {
    form.patch(route('admin.roles.update',role), {
        errorBag: 'addPermissionToRole',
        preserveScroll: true,
    });
};
</script>
<template>
        <Show title="role.name">


            <div class="mb-20">
                <p class="px-6 py-2 my-2 bg-gray-600">{{ role.name }}</p>
                <p class="flex flex-col px-6 py-2 my-2 mx-6"
                   v-for="permission in role.permissions"
                >
                    {{ permission.name }}
                </p>
            </div>


            <!--
                        <button class="bg-white p-2 text-black" @click="console.log(roles)">user</button>
            -->


            <FormSection @submitted="addPermissionToRole(role)">
                <template #title>
                    Add Permission to Role
                </template>

                <template #description>
                    Add a new Permission to Role.
                </template>

                <template #form>
                    <div class="col-span-6">
                        <InputLabel value="Permission" />

                        <div class="flex items-center mt-2">
                            <div class="ml-4 leading-tight">
                                <select v-model="form.name" class="bg-gray-300 text-gray-900">
                                    <option v-for="permission in permissions"
                                            :id="permission.id"
                                            :value="permission.name"
                                            type="text"
                                            class="block w-full mt-1"
                                            autofocus
                                    >
                                        {{ permission.name }}
                                    </option>
                                </select>

                            </div>
                        </div>
                    </div>

                </template>

                <template #actions>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add Permission to Role
                    </PrimaryButton>
                </template>
            </FormSection>

        </Show>
</template>
