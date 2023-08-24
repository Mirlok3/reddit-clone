<template>
    <guest-layout>
<!--        TODO: Sort by-->
        <div class="flex justify-center" v-if="$page.props.auth.user">
            <div class="md:mb-0 mb-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <BreezeNavLink :href="route('subscribed')"
                               :active="route().current('subscribed')"
                               class="text-lg mr-5" >
                    <span class="mr-1.5">Subscribed Page</span>
                </BreezeNavLink>
                <BreezeNavLink :href="route('welcome')"
                               :active="route().current('welcome')"
                               class="text-lg mr-5" >
                    <span class="mr-1.5">Front Page</span>
                </BreezeNavLink>
            </div>
        </div>
        <section class="md:flex md:m-2 md:p-2">
            <div class="w-full md:w-9/12">
                <Link :href="route('posts.create')"
                    class="mb-4 flex rounded-lg border border-gray-200 bg-white shadow-md dark:border dark:border-neutral-500 dark:bg-neutral-700 dark:text-white
                           dark:hover:bg-opacity-80 hover:bg-opacity-50">
                    <div class="flex w-12 flex-col justify-center rounded-l-lg bg-slate-300 p-3 text-center dark:bg-neutral-900 dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="px-4 p-2 text-2xl dark:hover:text-indigo-400 hover:text-indigo-700 font-bold">
                        Create a post....
                    </div>
                </Link>

                <EmptyState v-if="!posts.data[0]" :message="'You have no subscribed subreddits!'"/>

                <PostCard v-for="post in posts.data"
                    :post="post"
                    :subreddit="post.subreddit_slug"
                    :key="post.id"
                />
                <div class="mt-4 p-2">
                    <Pagination :links="posts.meta.links" />
                </div>
            </div>
            <div class="ml-3 hidden w-3/12 flex-col md:flex">
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
import { Link } from "@inertiajs/inertia-vue3";
import BreezeNavLink from "@/Components/NavLink.vue";
import EmptyState from "@/Components/EmptyState.vue";

defineProps({
    subreddits: Object,
    posts: Object,
})
</script>
