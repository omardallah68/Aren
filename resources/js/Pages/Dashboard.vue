<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import Welcome from '@/Components/Welcome.vue';
import {onMounted} from "vue";


defineProps({
    user: Object,
    users: Array,
    roles: Array,
    permissions: Array,
    teams: Array,
})

const form = useForm({
  name: '',
});

const addRoleToUser = (user) => {
  form.patch(route('admin.users.update',user), {
    errorBag: 'addRoleToUser',
    preserveScroll: true,
  });
};


const Rform = useForm({
  name: '',
  guard_name:'',
});

const createRole = () => {
  Rform.post(route('admin.roles.store'), {
    errorBag: 'createUser',
    preserveScroll: true,
  });
};

</script>

<template>
    <Head title="Dashboard" />
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <Welcome :users="users" :roles="roles" :permissions="permissions" :teams="teams" />
                <spline-viewer url="https://prod.spline.design/Sg7xJosPVm2yimJw/scene.splinecode"></spline-viewer>            </div>
        </div>
    </div>

</template>
