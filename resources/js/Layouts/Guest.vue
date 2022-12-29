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
        <div class="min-h-screen bg-gray-100 dark:bg-neutral-900">
            <nav class="bg-white border-b border-gray-100 dark:border-gray-600 dark:bg-neutral-800 dark:text-white">
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
                                                       :active="route().current('welcome')">
                                            Home page
                                        </BreezeNavLink>
                                    </div>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" v-if="$page.props.auth.user != null">
                                        <BreezeNavLink :href="route('subreddits.index')"
                                                       :active="route().current('subreddits.index')">
                                            Your Subreddits
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
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative" v-if="$page.props.auth.auth_check">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150
                                                           dark:bg-neutral-900 dark:text-white dark:hover:text-neutral-200">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                     fill="currentColor" class="w-5 h-5 mr-1">
                                                      <path fill-rule="evenodd"
                                                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                                            clip-rule="evenodd"/>
                                                </svg>

                                                {{ $page.props.auth.user.name }}

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
                                        <BreezeDropdownLink :href="route('subreddits.index')">
                                            Your Subreddits
                                        </BreezeDropdownLink>

                                        <BreezeDropdownLink :href="route('profile.show', $page.props.auth.user.username)">
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

                            <template v-else>
                                <div class="rounded-full dark:bg-neutral-900 dark:text-white p-3">
                                    <Link :href="route('login')" class="text-md text-gray-700 dark:text-white underline dark:hover:text-neutral-200">
                                        Log in
                                    </Link>

                                    <Link :href="route('register')"
                                          class="ml-4 text-md text-gray-700 dark:text-gray-500 underline dark:text-white dark:hover:text-neutral-200">Register
                                    </Link>
                                </div>
                            </template>
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
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('subreddits.index')"
                                                 :active="route().current('subreddits.index')">
                            Subreddits
                        </BreezeResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow bg-indigo-600" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
                <slot/>
            </main>
        </div>
    </div>
</template>
