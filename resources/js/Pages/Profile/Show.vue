<template>
    <Head title="Profile"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div class="py-6">
            <div class="bg-gray-100">
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex no-wrap md:-mx-2">
                        <!-- Left Side -->
                        <div class="w-full md:w-3/12 md:mx-2">
                            <!-- Profile Card -->
                            <div class="bg-white p-3 border-t-4 border-indigo-400">
                                <div class="flex items-center px-6 pt-2 pb-6">
                                    <div class="rounded-full pr-8">
                                        <img :src="'/' + user.user_image" class="w-16 h-16 rounded-full ring-4 ring-indigo-600">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ user.name }}</h1>
                                        <hr>
                                        <h1 class="text-gray-700 font-bold text-lg leading-8 my-1">{{ user.username}}</h1>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 hover:text-gray-600 leading-6"> {{ user.description }}</p>

                                <div class="flex items-center justify-between pt-6 px-12">
                                    <div>
                                        <div class="font-semibold">Karma</div>
                                        <div class="font-extralight">{{ voteCount }}</div>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Posts</div>
                                        <div class="font-extralight">{{ postCount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Right Side -->
                        <div class="w-full md:w-9/12 mx-2 h-64">
                            <PostCard v-for="post in posts.data"
                                      :post="post"
                                      :subreddit="post.subreddit_slug"
                                      :key="post.id"
                            />
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
