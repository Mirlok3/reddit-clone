<template>
    <guest-layout>
        <section class="flex md:flex-row m-2 p-2">
            <div class="w-8/12">
                <PostCard v-for="post in posts.data"
                    :post="post"
                    :subreddit="post.subreddit_slug"
                    :key="post.id"
                />
                <!-- <div class="mt-4 p-2">
                    <Pagination :links="posts.meta.links" />
                </div> -->
            </div>
            <div class="w-4/12 p-4">
                <div class="m-2 p-2">
                    <SubredditList :subreddits="subreddits.data" />
                </div>
            </div>
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import SubredditList from "@/Components/SubredditList.vue";

defineProps({
    subreddits: Object,
    posts: Object,
})
</script>
