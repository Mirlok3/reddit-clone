<template>
    <Head title="Profile"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight text-white">
                Profile
            </h2>
        </template>

        <div class="py-6">
            <div>
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex md:-mx-2">
                        <!-- Left Side -->
                        <div class="w-full md:w-3/12 md:mx-2 mb-4 rounded-lg">
                            <!-- Profile Card -->
                            <div class="dark:border dark:border-neutral-500 bg-white dark:bg-neutral-700 p-3 border-t-8 border-indigo-600 dark:text-white rounded-lg">
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
                                        <div class="font-extralight text-center">{{ user.posts_count }}</div>
                                    </div>
                                </div>
                            </div>
                            <SubredditList class="mt-4" :subreddits="subreddits.data" title="Users Subreddits" v-if="subreddits.data[0]"/>
                        </div>

                        <!--Right Side -->
                        <div class="w-full md:w-9/12 md:ml-4">
                            <EmptyState v-if="!user.posts_count" message="You have no posts..." />

                            <PostCard v-for="post in posts.data"
                                      :post="post"
                                      :subreddit="post.subreddit_slug"
                                      :key="post.id"
                            />

                            <div class="mt-4 p-2" v-if="user.posts_count">
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
import EmptyState from "@/Components/EmptyState.vue";
import SubredditList from "@/Components/SubredditList.vue";

defineProps({
    user: Object,
    subreddits: Object,
    posts: Object,
    voteCount: Number,
})

</script>
