<template>
    <guest-layout>
        <template #header>
            <div class="flex m-2 justify-between items-center">
                <div class="flex">
                    <div class="avatar">
                        <img :src="subreddit.subreddit_image" class="w-16 h-16 rounded-full ring-8 ring-indigo-600">
                    </div>
                    <h2 class="font-semibold text-4xl text-gray-800 my-auto mx-6">r/{{ subreddit.name }}</h2>
                </div>

                <Link v-if="$page.props.auth.auth_check" class="px-3 py-2 rounded bg-indigo-500 hover:bg-indigo-700 text-white"
                :href="route('subreddits.posts.create', subreddit.slug)">Create a post</Link>
            </div>
        </template>

        <section class="flex md:flex-row m-2 p-2">
            <div class="w-8/12">
                <PostCard v-for="post in posts.data"
                    :post="post"
                    :subreddit="subreddit.slug"
                    :key="post.id"
                />

                <div class="mt-4 p-2">
                    <Pagination :links="posts.meta.links" />
                </div>
            </div>
            <div class="w-4/12 p-4">
                <div class="m-2 p-2">
                    <div class="shadow-md">
                        <h2 class="font-semibold text-large p-4 bg-indigo-700 text-white rounded-t-lg">
                            About {{ subreddit.name }}
                        </h2>
                        <p class="p-4 bg-white rounded-b-lg">
                            {{ subreddit.description }}
                        </p>
                    </div>
                </div>
                <div class="m-2 p-2 mt-6">
                    <SubredditList :subreddits="subreddits.data" />
                </div>
            </div>
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import SubredditList from "@/Components/SubredditList.vue";

defineProps({
    subreddit: Object,
    subreddits: Object,
    posts: Object,
})
</script>
