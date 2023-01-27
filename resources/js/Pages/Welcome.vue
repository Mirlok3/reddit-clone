<template>
    <guest-layout>
        <section class="md:flex md:m-2 md:p-2">
            <div class="md:w-9/12 w-full">
                <PostCard v-for="post in posts.data"
                    :post="post"
                    :subreddit="post.subreddit_slug"
                    :key="post.id"
                />
                <div class="mt-4 p-2">
                    <Pagination :links="posts.meta.links" />
                </div>
            </div>
            <div class="hidden lg:flex flex-col w-4/12 ml-3">
                <div>
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
