<template>
    <guest-layout>
        <template #header>
            <SubredditHeader :subreddit="subreddit" :ifUserSubscribed="ifUserSubscribed" />
        </template>

        <section class="md:flex md:flex-row">
            <div class="md:w-9/12 sm:w-full">
                <EmptyState v-if="!subreddit.posts_count" :message="'Be the first to post in r/' + subreddit.name "/>

                <PostCard v-for="post in posts.data"
                    :post="post"
                    :subreddit="subreddit.slug"
                    :key="post.id"
                />

                <div class="mt-4 p-2" v-if="subreddit.posts_count">
                    <Pagination :links="posts.meta.links" />
                </div>
            </div>

            <!-- Sidebar -->
            <SubredditSideBar :subreddit="subreddit" :subreddits="subreddits" :auth="can_delete"/>
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import EmptyState from "@/Components/EmptyState.vue";
import SubredditSideBar from "@/Components/SubredditSideBar.vue";
import SubredditHeader from "@/Components/SubredditHeader.vue";

defineProps({
    subreddit: Object,
    subreddits: Object,
    posts: Object,
    ifUserSubscribed: Number,
    fileExt: String,
    can_delete: Boolean,
})
</script>
