<template>
    <Head title="Admin panel"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <SubredditHeader :subreddit="subreddit" :ifUserSubscribed="ifUserSubscribed" />
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="bg-gray-200 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg dark:bg-neutral-700 border dark:border dark:border-neutral-400">
                                    <table class="min-w-full divide-gray-300">
                                        <thead class="bg-gray-200 dark:bg-neutral-700">
                                            <tr>
                                                <th scope="col" class="relative py-3.5 dark:text-white">
                                                    <span class="sr-only">User Icon</span>
                                                </th>
                                                <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                                    Name</th>
                                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                                    Username</th>
                                                <th scope="col" class="py-3.5 px-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                                    Give a role
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200 bg-white dark:bg-neutral-900">
                                            <tr v-for="user in subscribedUsers.data" :key="subscribedUsers.id">
                                                <td>
                                                    <Link :href="route('profile.show', user.users.username)"
                                                          class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300">
                                                        <img :src="'/' + user.users.user_image" alt="" class="w-8 h-8 rounded-full ring-2 ring-gray-400 m-2"> <!--TODO: Fix user image upload to have /-->
                                                    </Link>
                                                </td>
                                                <td class="whitespace-nowrap py-4 pr-3 text-md font-medium text-gray-900 flex">
                                                    <UserRole :role="user.role" />
                                                    <Link :href="route('profile.show', user.users.username)"
                                                          class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300">
                                                        {{ user.users.name }}
                                                    </Link>
                                                </td>
                                                <td class="whitespace-nowrap py-4 pr-3 text-md font-medium text-gray-900">
                                                    <Link :href="route('profile.show', user.users.username)"
                                                          class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300">
                                                        {{ user.users.username }}
                                                    </Link>
                                                </td>

                                                <td class="whitespace-nowrap py-4 pr-3 text-md font-bold">
                                                    <div v-if="subreddit.user_id != user.users.id" class="flex justify-center">
                                                        <Link
                                                            :href="route('subreddit.users.giveRole', [subreddit.id, user.users.id, 'admin'])"
                                                            class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300 flex mx-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor"
                                                                 class="w-5 h-5 text-blue-600 dark:text-blue-500">
                                                                <path fill-rule="evenodd"
                                                                      d="M9.661 2.237a.531.531 0 01.678 0 11.947 11.947 0 007.078 2.749.5.5 0 01.479.425c.069.52.104 1.05.104 1.59 0 5.162-3.26 9.563-7.834 11.256a.48.48 0 01-.332 0C5.26 16.564 2 12.163 2 7c0-.538.035-1.069.104-1.589a.5.5 0 01.48-.425 11.947 11.947 0 007.077-2.75zm4.196 5.954a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                            <span>Admin</span>
                                                        </Link>
                                                        <Link
                                                            :href="route('subreddit.users.giveRole', [subreddit.id, user.users.id, 'moderator'])"
                                                            class="text-blue-500 hover:text-blue-700 font-semibold dark:text-white dark:hover:text-blue-300 flex mx-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor"
                                                                 class="w-5 h-5 text-green-600 dark:text-green-500">
                                                                <path fill-rule="evenodd"
                                                                      d="M9.661 2.237a.531.531 0 01.678 0 11.947 11.947 0 007.078 2.749.5.5 0 01.479.425c.069.52.104 1.05.104 1.59 0 5.162-3.26 9.563-7.834 11.256a.48.48 0 01-.332 0C5.26 16.564 2 12.163 2 7c0-.538.035-1.069.104-1.589a.5.5 0 01.48-.425 11.947 11.947 0 007.077-2.75zm4.196 5.954a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>

                                                            <span>Moderator</span>
                                                        </Link>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="mt-2 mb-1.5 mx-2">
                                        <Pagination :links="subscribedUsers.links"/>
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
import Pagination from '@/Components/Pagination.vue';
import EmptyState from "@/Components/EmptyState.vue";
import SubredditHeader from "@/Components/SubredditHeader.vue";
import UserRole from "@/Components/UserRole.vue";

const props = defineProps({
    subscribedUsers: Object,
    subreddit: Object,
})

console.log(props.subscribedUsers.data)

</script>
