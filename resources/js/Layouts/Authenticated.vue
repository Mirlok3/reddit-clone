<script setup>
import {ref} from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <!-- Message -->
        <div v-if="$page.props.flash.message" class="bg-green-400">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <p class="ml-3 font-medium text-white truncate">
                            <span class="md:hidden">{{ $page.props.flash.message }}</span>
                            <span class="hidden md:inline">{{ $page.props.flash.message }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="min-h-screen bg-gray-100 dark:bg-neutral-900">
            <nav class="bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-neutral-800 dark:text-white">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <div class="flex">
                                    <!-- Logo -->
                                    <div class="shrink-0 flex items-center dark:bg-gray-200 rounded-full p-1.5">
                                        <Link href="/">
                                            <BreezeApplicationLogo class="block h-9 w-auto"/>
                                        </Link>
                                    </div>

                                    <h2 class="font-semibold text-xl my-auto ml-10">Reggit</h2>

                                    <!-- Navigation Links -->
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <BreezeNavLink :href="route('welcome')"
                                                       :active="route().current('welcome') || route().current('subscribed')">
                                            Home page
                                        </BreezeNavLink>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Links
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <BreezeNavLink :href="route('subreddits.index')" :active="route().current('dashboard')">
                                    Subreddits
                                </BreezeNavLink>
                            </div>-->
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Profile Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150
                                                           bg-neutral-200 dark:bg-neutral-900 dark:text-white dark:hover:text-neutral-200">

                                                <img :src="'/' + $page.props.auth.user.user_image" alt="" class="w-8 h-8 rounded-full">
                                                <span class="my-auto pl-2">{{ $page.props.auth.user.name }}</span>

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>
                                    <template #content>
                                        <BreezeDropdownLink :href="route('subreddits.index')"
                                                            :active="route().current('dashboard')">
                                            Your Subreddits
                                        </BreezeDropdownLink>

                                        <BreezeDropdownLink
                                            :href="route('profile.show', $page.props.auth.user.username)">
                                            Profile
                                        </BreezeDropdownLink>

                                        <BreezeDropdownLink :href="route('profile.edit', $page.props.auth.user.name)">
                                            Profile Settings
                                        </BreezeDropdownLink>

                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"/>
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                     class="sm:hidden">
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <!-- Navigation Links -->
                        <BreezeResponsiveNavLink class="flex"
                            :href="route('profile.show', $page.props.auth.user.username)"
                            :active="route().current('profile.show')">
                            <img :src="'/' + $page.props.auth.user.user_image" alt="" class="w-8 h-8 rounded-full">
                            <p class="my-auto pl-2">{{ $page.props.auth.user.name }}</p>
                        </BreezeResponsiveNavLink>

                        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex dark:bg-neutral-800">
                            <BreezeResponsiveNavLink :href="route('welcome')"
                                                     :active="route().current('welcome') || route().current('subscribed')">
                                Home page
                            </BreezeResponsiveNavLink>
                        </div>

                        <div v-if="$page.props.auth.user != null">
                            <BreezeResponsiveNavLink :href="route('subreddits.index')"
                                                     :active="route().current('subreddits.index')">
                                Your Subreddits
                            </BreezeResponsiveNavLink>
                        </div>

                        <BreezeResponsiveNavLink :href="route('login')" :active="route().current('login')" v-if="!$page.props.auth.auth_check">
                            Log in
                        </BreezeResponsiveNavLink>

                        <BreezeResponsiveNavLink :href="route('register')" :active="route().current('register')" v-if="!$page.props.auth.auth_check">
                            Register
                        </BreezeResponsiveNavLink>

                        <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button" v-if="$page.props.auth.auth_check">
                            Log Out
                        </BreezeResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-indigo-600 shadow " v-if="$slots.header">
                <slot name="header"/> <!--TODO: Create non subreddit header-->
            </header>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>
