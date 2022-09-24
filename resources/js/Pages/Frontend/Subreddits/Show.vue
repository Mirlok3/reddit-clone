<template>
    <guest-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                r/{{ subreddit.name }}
            </h2>
            <div class="flex justify-end m-2 p-2">
                <Link v-if="$page.props.auth.auth_check" class="px-3 py-4 rounded bg-indigo-500 hover:bg-indigo-700 text-white"
                :href="route('subreddits.posts.create', subreddit.slug)">Create a post</Link>
            </div>
        </template>

        <section class="m-2 p-2">
            <PostCard v-for="post in posts.data" :post="post" :subreddit="subreddit.name" :key="post.id" />
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import PostCard from "@/Components/PostCard.vue";

defineProps({
    subreddit: Object,
    posts: Object,
})
</script>
