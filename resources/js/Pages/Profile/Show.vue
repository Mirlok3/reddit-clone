<template>
    <Head title="Profile"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-white">
                <h2 class="text-xl font-semibold leading-tight text-white">
                    Profile
                </h2>
            </div>
        </template>

        <div class="py-6">
            <div>
                <div class="mx-auto my-5">
                    <div class="lg:flex lg:mx-16">
                        <!-- Left Side -->
                        <div class="w-full rounded-lg border-t-8 border-t-indigo-600 lg:w-2/12 lg:mx-2">
                            <!-- Profile Card -->
                            <div class="rounded-b-lg bg-white p-3 shadow-md dark:bg-neutral-700 dark:text-white dark:border-x dark:border-b dark:border-neutral-500">
                                <div class="flex items-center px-6 pt-2 pb-6">
                                    <div class="shrink-0 rounded-full pr-8">
                                        <img :src="'/' + user.user_image" class="h-16 w-16 rounded-full ring-4 ring-indigo-600">
                                    </div>
                                    <div>
                                        <h1 class="my-1 text-xl font-bold leading-8 text-gray-900 dark:text-white">{{ user.name }}</h1>
                                        <hr>
                                        <h1 class="my-1 text-lg font-bold leading-8 text-gray-700 dark:text-white">{{ user.username}}</h1>
                                    </div>
                                </div>
                                <div class="h-20 min-h-max rounded-lg bg-gray-200 px-2 py-3 dark:bg-neutral-800">
                                    <p class="ml-3 text-sm leading-6 text-gray-500 dark:text-gray-300"> {{ user.description }}</p>
                                </div>

                                <div class="flex items-center justify-between px-12 pt-6">
                                    <div>
                                        <div class="font-semibold">Karma</div>
                                        <div class="text-center font-extralight">{{ voteCount }}</div>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Posts</div>
                                        <div class="text-center font-extralight">{{ user.posts_count }}</div>
                                    </div>
                                </div>
                            </div>
                            <SubredditList class="my-6" :subreddits="subreddits.data" title="Users Subreddits" v-if="subreddits.data[0]"/>
                            <hr class="p-3 lg:hidden">
                        </div>

                        <!--Middle Side -->
                        <div class="lg:w-7/12 lg:ml-4">
                            <h2 class="py-2 text-center text-2xl font-bold dark:text-white">Posts</h2>
                            <EmptyState v-if="!user.posts_count" message="You have no posts..." />

                            <PostCard v-for="post in posts.data"
                                      :post="post"
                                      :subreddit="post.subreddit_slug"
                                      :key="post.id"
                            />

                            <div class="mt-4 p-2" v-if="user.posts_count">
                                <Pagination :links="posts.meta.links" v-if="posts.meta.last_page !== 1" />
                            </div>
                        </div>

                        <!--Right Side -->
                        <div class="w-full lg:w-3/12 lg:ml-4">
                            <h2 class="my-2 text-center text-2xl font-bold dark:text-white">Comments</h2>
                            <div class="rounded-md dark:bg-neutral-700 dark:border dark:border-neutral-500">
                                <EmptyState v-if="!comments.data[0]" message="This user has no comments..."/>

                                <ProfileComment
                                    v-for="(comment, index) in comments.data"
                                    :comment="comment" type="comments"
                                />
                            </div>

                            <div class="mt-4 p-2" v-if="user.posts_count">
                                <Pagination :links="comments.meta.links" v-if="comments.meta.last_page !== 1"/>
                            </div>

                            <hr class="m-3">

                            <h2 class="py-2 text-center text-2xl font-bold dark:text-white">Replies</h2>
                            <div class="rounded-md dark:bg-neutral-700 dark:border dark:border-neutral-500">
                                <EmptyState v-if="!replies.data[0]" message="This user has no replies..."/>

                                <ProfileComment
                                    v-for="(reply, index) in replies.data"
                                    :comment="reply" type="replies"
                                />
                            </div>

                            <div class="mt-4 p-2" v-if="user.posts_count">
                                <Pagination :links="replies.meta.links" v-if="comments.meta.last_page !== 1"/>
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
import { Head } from '@inertiajs/inertia-vue3';
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import EmptyState from "@/Components/EmptyState.vue";
import SubredditList from "@/Components/SubredditList.vue";
import ProfileComment from "@/Components/ProfileComment.vue";

defineProps({
    user: Object,
    subreddits: Object,
    posts: Object,
    voteCount: Number,
    comments: Object,
    replies: Object,
})

</script>
