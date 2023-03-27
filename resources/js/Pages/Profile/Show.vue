<template>
    <Head title="Profile"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight text-white">
                Profile
            </h2>
        </template>

        <div class="py-6">
            <div >
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex md:-mx-2">
                        <!-- Left Side -->
                        <div class="w-full md:w-3/12 md:mx-2 mb-4 rounded-lg">
                            <!-- Profile Card -->
                            <div class="bg-white dark:bg-neutral-700 p-3 border-t-8 border-indigo-600 dark:text-white rounded-lg">
                                <div class="flex items-center px-6 pt-2 pb-6">
                                    <div class="rounded-full pr-8 shrink-0">
                                        <img :src="'/' + user.user_image" class="w-16 h-16 rounded-full ring-4 ring-indigo-600">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1 dark:text-white">{{ user.name }}</h1>
                                        <hr>
                                        <h1 class="text-gray-700 font-bold text-lg leading-8 my-1 dark:text-white">{{ user.username}}</h1>
                                    </div>
                                </div>
                                <div class="bg-gray-200 min-h-max py-3 px-2 h-20 rounded-lg dark:bg-neutral-800">
                                    <p class="text-sm text-gray-500 leading-6 dark:text-gray-300 ml-3"> {{ user.description }}</p>
                                </div>

                                <div class="flex items-center justify-between pt-6 px-12">
                                    <div>
                                        <div class="font-semibold mr-2">Karma</div>
                                        <div class="font-extralight text-center">{{ voteCount }}</div>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Posts</div>
                                        <div class="font-extralight text-center">{{ postCount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Right Side -->
                        <div class="w-full md:w-9/12 md:ml-4">
                            <div v-if="postCount == 0" class="font-semibold text-2xl text-gray-400 p-4 flex items-center flex-col">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                                <h2>There is nothing here....</h2>
                                <h2>Post Something!</h2>
                            </div>

                            <PostCard v-for="post in posts.data"
                                      :post="post"
                                      :subreddit="post.subreddit_slug"
                                      :key="post.id"
                            />

                            <div class="mt-4 p-2" v-if="postCount > 0">
                                <Pagination :links="posts.meta.links" />
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
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import SubredditList from "@/Components/SubredditList.vue";

defineProps({
    user: Object,
    subreddits: Object,
    posts: Object,
    voteCount: String,
    postCount: String,
})

</script>
