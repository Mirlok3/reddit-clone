<template>

    <Head title="Subreddits"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight text-white">
                Your Subreddits
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('subreddits.create')"
                                class="inline-flex items-center justify-center rounded-full border border-transparent bg-indigo-600 px-4 py-1.5 text-sm text-white shadow-sm hover:bg-indigo-700
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                <span class="mr-1.5">Create a Subreddit</span>
                            </Link>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="bg-gray-200 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg dark:bg-neutral-700 border dark:border-2 dark:border-neutral-400">
                                    <table class="min-w-full divide-gray-300">
                                        <thead class="bg-gray-200 dark:bg-neutral-700">
                                            <tr>
                                                <th scope="col" class="relative py-3.5 dark:text-white">
                                                    <span class="sr-only">Subreddit Icon</span>
                                                </th>
                                                <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                                    Name</th>
                                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                                    Slug</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 dark:text-white">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200 bg-white dark:bg-neutral-900">
                                            <tr v-for="subreddit in subreddits.data" :key="subreddit.id">
                                                <td>
                                                    <Link :href="route('frontend.subreddits.show', subreddit.slug)"
                                                          class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300">
                                                        <img :src=subreddit.subreddit_image alt="" class="w-10 h-10 rounded-full ring-1 ring-white p-1 ml-3">
                                                    </Link>
                                                </td>
                                                <td class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900">
                                                    <Link :href="route('frontend.subreddits.show', subreddit.slug)"
                                                        class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300">
                                                        {{ subreddit.name }}
                                                    </Link>
                                                </td>

                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">{{ subreddit.slug }}</td>


                                                <td class="relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <Link :href="route('subreddits.edit', subreddit.slug)"
                                                          class="text-white hover:bg-indigo-700 mr-3 bg-indigo-600 px-3 py-1.5 rounded-full">
                                                          Edit
                                                    </Link>

                                                    <Link :href="route('subreddits.destroy', subreddit.slug)"
                                                          method="delete" as="button" type="button"
                                                          class="text-white hover:bg-red-700 bg-red-600 px-3 py-1.5 rounded-full">
                                                          Delete
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <EmptyState v-if="!subreddits.from" message="You have no subreddits..." class="bg-white dark:bg-neutral-900"/>

                                    <div class="mt-2 mb-1.5 mx-2">
                                        <Pagination :links="subreddits.links"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '../../Components/Pagination.vue';
import EmptyState from "@/Components/EmptyState.vue";

defineProps({
    subreddits: Object
})

</script>
