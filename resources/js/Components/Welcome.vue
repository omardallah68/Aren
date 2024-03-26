<script>
import {Link, usePage} from "@inertiajs/vue3";
import imgLink from './Lion.png'
import videoLink from './Komp 1_2.mp4'
import NavLink from "@/Components/NavLink.vue";
import Chart from 'chart.js/auto';

export default {
    components: {NavLink, Link},
    props: {
        user: Object,
        users: Array,
        roles: Array,
        permissions: Array,
        teams: Array,
    },
    data(){
        return {
            img: imgLink,
            video: videoLink,
            chart: null,
            radarChart: null,
            roles_data: []

        }
    },
    mounted() {
        this.get_roles_data();
        this.renderChart();
        window.onbeforeunload = function () {
            window.scrollTo(0, 100)
        }
    },
    methods: {
        get_roles_data() {
            this.roles.forEach((role) => {const obj = {name: role.name, users_count:role.users_count}; this.roles_data.push(obj)})
        },
        renderChart() {
            /*const ctx = this.$refs.myChart.getContext('2d');

            this.chart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ['Users', 'Roles', 'Permissions', 'Teams'],
                    datasets: [
                        {
                            label: 'Number',
                            backgroundColor: ['rgb(56,56,21)', 'rgb(18,47,18)', 'rgb(15,38,38)', 'rgb(30,23,61)'],
                            borderColor: ['rgb(192,190,75)', 'rgb(75,192,77)', 'rgb(75,188,192)', 'rgb(96,75,192)'],
                            borderWidth: 1,
                            data: [this.users.length, this.roles.length, this.permissions.length, this.teams.length],
                            hoverOffset: 4
                        },
                    ],
                },
                options: {
                scale: {
                    ticks: {
                        display: false,
                    },
                    pointLabels: {
                        display: false,
                    },
                },
            },
            });*/
            const ctx2 = this.$refs.my2Chart.getContext('2d');
            const role = this.roles_data.map((role) => role.name)
            console.log(role)
            const users_counts = this.roles_data.map((role) => role.users_count)
            this.radarChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: role,
                    datasets: [
                        {
                            label: 'User',
                            backgroundColor:['rgb(255,81,41)', 'rgb(255,219,35)', 'rgb(72,196,41)', 'rgb(255,2,2)', 'rgb(41,82,255)'] ,
                            borderColor: ['rgb(255,81,41)', 'rgb(255,219,35)', 'rgb(72,196,41)', 'rgb(255,2,2)', 'rgb(41,82,255)'],
                            borderWidth: 1,
                            data: users_counts,
                            hoverOffset: 4,

                        },
                    ],
                }
            });
        },
    },
}
</script>

<template>
    <div>
<!--        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

            <div class="flex flex-row w-full items-start justify-around pt-20 px-[1.5vw] py-[1.5vh]">
                <div class="w-[150px] h-[150px] rounded-full rounded-tl-none rotate-45 bg-yellow-500">
                    <img :src="img" alt="" class="z-10 -rotate-45">
                </div>
                <h1 class="text-white text-8xl font-extrabold p-2 transition-all ease-in-out duration-300">عرين الأسود</h1>
            </div>

            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
            </p>
        </div>-->

        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

            <a href="/pulse" class="text-white text-2xl hover:text-blue-500"
               v-if="$page.props.user_roles.includes('super-admin')"
            >
                Laravel Pulse
            </a>

        </div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

            <video autoplay muted>
                <source :src="video" type="video/mp4">
            </video>

        </div>

        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent flex justify-center border-b border-gray-200 dark:border-gray-700">

<!--
            <div class="w-1/4"><canvas class="h-full w-full" ref="myChart"></canvas></div>
-->
            <div><canvas ref="my2Chart"></canvas></div>


        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <div class="flex items-center">
                    <font-awesome-icon icon="fa-solid fa-gears" class="text-white" />
                    <Link :active="route().current('admin.')" :href="route('admin.')" class="ml-3 text-xl font-semibold text-white">
                        Admin
                    </Link>
                </div>


                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi delectus dicta dolore dolores eius error ex fuga fugiat ipsam magni mollitia nemo nobis omnis perspiciatis praesentium quaerat, sed suscipit temporibus.
                </p>

                <p class="mt-4 text-sm">
                    <Link :active="route().current('admin.')" :href="route('admin.')" class="text-sm font-semibold text-indigo-300 flex flex-row">
                        Explore the Admin
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <font-awesome-icon icon="fa-solid fa-sticky-note" class="text-white" />
                    <Link :active="route().current('notes')" :href="route('notes')"  class="ml-3 text-xl font-semibold text-white">
                        Notes
                    </Link>
                </div>


                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi delectus dicta dolore dolores eius error ex fuga fugiat ipsam magni mollitia nemo nobis omnis perspiciatis praesentium quaerat, sed suscipit temporibus.
                </p>

                <p class="mt-4 text-sm">
                    <Link :active="route().current('notes')" :href="route('notes')" class="text-sm font-semibold text-indigo-300 flex flex-row">
                        Explore the Notes
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <font-awesome-icon icon="fa-solid fa-house" class="text-gray-600" />
                    <Link :active="route().current('dashboard')" :href="route('dashboard')" class="ml-3 text-xl font-semibold text-gray-600">
                        Dashboard
                    </Link>
                </div>


                <p class="mt-4 text-gray-600 dark:text-gray-600 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi delectus dicta dolore dolores eius error ex fuga fugiat ipsam magni mollitia nemo nobis omnis perspiciatis praesentium quaerat, sed suscipit temporibus.
                </p>

                <p class="mt-4 text-sm text-gray-600">
                    <Link :active="route().current('dashboard')" :href="route('dashboard')" class="text-sm font-semibold text-gray-600 flex flex-row">
                        Explore the Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-gray-600 dark:fill-gray-600">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>


            <div>
                <div class="flex items-center">
                    <font-awesome-icon icon="fa-solid fa-house" class="text-gray-600" />
                    <Link :active="route().current('dashboard')" :href="route('dashboard')" class="ml-3 text-xl font-semibold text-gray-600">
                        Dashboard
                    </Link>
                </div>


                <p class="mt-4 text-gray-600 dark:text-gray-600 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi delectus dicta dolore dolores eius error ex fuga fugiat ipsam magni mollitia nemo nobis omnis perspiciatis praesentium quaerat, sed suscipit temporibus.
                </p>

                <p class="mt-4 text-sm text-gray-600">
                    <Link :active="route().current('dashboard')" :href="route('dashboard')" class="text-sm font-semibold text-gray-600 flex flex-row">
                        Explore the Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-gray-600 dark:fill-gray-600">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>
