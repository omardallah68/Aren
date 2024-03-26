<script setup>
import {Link, router} from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import DropUp from "@/Components/DropUp.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import {ref, watch} from "vue";

defineProps({
    title: String,
    isSidebarExpanded:{
        type: Boolean,
        default: false
    }
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
    <div class="w-full h-full bg-[#057af0]/80 border-r-[1px] border-yellow-500">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl">
            <div class="flex flex-col">
                <div class="flex flex-col h-[100vh] justify-between py-10">
                    <div>
                        <!-- Logo -->
                        <div class="after:mt-16 after:bg-yellow-500 after:w-[80%] after:h-[.1px] after:content-[''] after:absolute after:left-[10%]">
                            <Link :href="route('dashboard')"
                                  class="fixed transition-all ease-in-out"
                                  :class="isSidebarExpanded ? 'w-[15vw]' : 'w-[4vw]'"
                            >
                                <ApplicationMark :is_sidebar_expanded="isSidebarExpanded"/>
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-y-2 sm:flex flex-col items-center mt-24 w-full">
                            <NavLink :active="route().current('dashboard')"
                                     :href="route('dashboard')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-house"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    Dashboard
                                </span>
                            </NavLink>
                            <NavLink :active="route().current('admin.')"
                                     :href="route('admin.')"
                                     v-if="$page.props.user_roles.includes('super-admin')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-gears"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >Admin
                                </span>
                            </NavLink>
                            <NavLink :active="route().current('notes')"
                                     :href="route('notes')"
                                     v-if="$page.props.user_roles.includes('editor') || $page.props.user_roles.includes('super-admin')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-sticky-note" class="mr-1"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    Notes
                                </span>
                            </NavLink>
                            <NavLink :active="route().current('store')"
                                     :href="route('store')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-shop" class="-ml-1"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    Store
                                </span>
                            </NavLink>
                            <NavLink :active="route().current('calendar')"
                                     :href="route('calendar')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-calendar-days" class="mr-1"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    Calendar
                                </span>
                            </NavLink>
                            <NavLink :active="route().current('about-me')"
                                     :href="route('about-me')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-circle-info"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    About me
                                </span>
                            </NavLink>
                            <NavLink :active="$page.url.split('/')[1] === 'tinker' ? true : false"
                                     href="/tinker"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-terminal"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    Web Tinker
                                </span>
                            </NavLink>
                            <NavLink :active="route().current('tickets-page')"
                                     :href="route('tickets-page')"
                                     class="w-full justify-start min-h-[5vh] px-[1.5vw]"
                            >
                                <font-awesome-icon icon="fa-solid fa-list-check"/>
                                <span
                                    class="ml-5 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap"
                                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
                                >
                                    Tickets
                                </span>
                            </NavLink>
                        </div>
                    </div>

                <div class="flex items-center flex-col after:mb-2 after:bg-yellow-500 after:w-[80%] after:h-[.1px] after:content-[''] after:absolute after:left-[10%]">
                    <div class="flex flex-row items-center w-full justify-start pl-[1.5vw] pr-1 max-h-14 mt-2" :active="route().current('teams.*')">
                        <font-awesome-icon icon="fa-solid fa-people-group" class="text-white flex"/>
                        <div
                            class="relative transition-all ease-in-out delay-700 duration-300"
                            :class="isSidebarExpanded ? 'opacity-100 flex' : 'opacity-0 hidden'"
                        >
                            <!-- Teams Dropdown -->
                            <DropUp v-if="$page.props.jetstream.hasTeamFeatures" align="left" width="60">
                                <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    class="transition-all inline-flex text-clip items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black dark:text-white bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-transparent active:bg-transparent dark:active:bg-transparent ease-in-out duration-150"
                                                    :class="isSidebarExpanded ? 'whitespace-pre-wrap opacity-100' : 'whitespace-nowrap opacity-0'"
                                                    type="button">
                                                    <svg class="mr-2 -ml-0.5 h-4 w-4" fill="none"
                                                                       stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                                                       xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                                              stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                    {{ $page.props.auth.user.current_team.name }}
                                                </button>
                                            </span>
                                </template>

                                <template #content>
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <template v-if="$page.props.jetstream.hasTeamFeatures">
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <DropdownLink
                                                :href="route('teams.show', $page.props.auth.user.current_team)">
                                                Team Settings
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream.canCreateTeams"
                                                          :href="route('teams.create')">
                                                Create New Team
                                            </DropdownLink>

                                            <!-- Team Switcher -->
                                            <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                <div class="border-t border-gray-200 dark:border-gray-600"/>

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.auth.user.all_teams"
                                                          :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <DropdownLink as="button">
                                                            <div class="flex items-center">
                                                                <svg
                                                                    v-if="team.id == $page.props.auth.user.current_team_id"
                                                                    class="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"/>
                                                                </svg>

                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </template>
                                    </div>
                                </template>
                            </DropUp>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="flex flex-row items-center w-full justify-start mt-2 pl-[1.5vw] pr-1 max-h-14" :active="route().current('profile.*')">
                        <font-awesome-icon icon="fa-solid fa-user" class="text-white flex"/>
                        <div
                            class="relative transition-all ease-in-out duration-300 delay-700"
                            :class="isSidebarExpanded ? 'opacity-100 flex' : 'opacity-0 hidden'"
                        >
                            <DropUp align="left" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img :alt="$page.props.auth.user.name"
                                             :src="$page.props.auth.user.profile_photo_url"
                                             class="h-8 w-8 rounded-full object-cover">
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black dark:text-white bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-transparent dark:focus:bg-transparent active:bg-gray-50 dark:active:bg-transparent transition ease-in-out duration-150"
                                                    :class="isSidebarExpanded ? 'whitespace-pre-wrap' : 'whitespace-nowrap'"

                                                    type="button">
                                                    <svg class="mr-2 ml-1 h-4 w-4 rotate-180"
                                                                        fill="none"
                                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                    {{ $page.props.auth.user.name }}
                                                </button>
                                            </span>
                                </template>

                                <template #content class="w-60 bottom-20 left-20">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <DropdownLink :href="route('profile.show')">
                                        Profile
                                    </DropdownLink>

                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                                  :href="route('api-tokens.index')">
                                        API Tokens
                                    </DropdownLink>

                                    <div class="border-t border-gray-200 dark:border-gray-600"/>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </template>
                            </DropUp>
                        </div>
                    </div>
                </div>

            </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                        @click="showingNavigationDropdown = ! showingNavigationDropdown">
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                d="M4 6h16M4 12h16M4 18h16"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                            <path
                                :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                d="M6 18L18 6M6 6l12 12"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
             class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :active="route().current('dashboard')" :href="route('dashboard')">
                    Dashboard
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="flex items-center px-4">
                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                        <img :alt="$page.props.auth.user.name"
                             :src="$page.props.auth.user.profile_photo_url"
                             class="h-10 w-10 rounded-full object-cover">
                    </div>

                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :active="route().current('profile.show')"
                                       :href="route('profile.show')">
                        Profile
                    </ResponsiveNavLink>

                    <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures"
                                       :active="route().current('api-tokens.index')"
                                       :href="route('api-tokens.index')">
                        API Tokens
                    </ResponsiveNavLink>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <ResponsiveNavLink as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </form>

                    <!-- Team Management -->
                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <div class="border-t border-gray-200 dark:border-gray-600"/>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <ResponsiveNavLink :active="route().current('teams.show')"
                                           :href="route('teams.show', $page.props.auth.user.current_team)">
                            Team Settings
                        </ResponsiveNavLink>

                        <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                                           :active="route().current('teams.create')"
                                           :href="route('teams.create')">
                            Create New Team
                        </ResponsiveNavLink>

                        <!-- Team Switcher -->
                        <template v-if="$page.props.auth.user.all_teams.length > 1">
                            <div class="border-t border-gray-200 dark:border-gray-600"/>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                <form @submit.prevent="switchToTeam(team)">
                                    <ResponsiveNavLink as="button">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                 class="mr-2 h-5 w-5 text-green-400"
                                                 fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </ResponsiveNavLink>
                                </form>
                            </template>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
