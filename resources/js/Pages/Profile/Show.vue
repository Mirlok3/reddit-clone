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
                <div class="mx-auto my-5 ">
                    <div class="lg:flex lg:mx-16">
                        <!-- Left Side -->
                        <div class="w-full lg:w-2/12 lg:mx-2 rounded-lg border-t-8 border-t-indigo-600">
                            <!-- Profile Card -->
                            <div class="shadow-md bg-white dark:bg-neutral-700 p-3  dark:text-white rounded-b-lg dark:border-x dark:border-b dark:border-neutral-500">
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
                                        <div class="font-semibold">Karma</div>
                                        <div class="font-extralight text-center">{{ voteCount }}</div>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Posts</div>
                                        <div class="font-extralight text-center">{{ user.posts_count }}</div>
                                    </div>
                                </div>
                            </div>
                            <SubredditList class="my-6" :subreddits="subreddits.data" title="Users Subreddits" v-if="subreddits.data[0]"/>
                            <hr class="lg:hidden p-3">
                        </div>

                        <!--Middle Side -->
                        <div class="w-full lg:w-8/12 lg:ml-4">
                            <h2 class="py-2 dark:text-white text-2xl text-center font-bold">Posts</h2>
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
                            <h2 class="my-2 dark:text-white text-2xl text-center font-bold">Comments</h2>
                            <div class="dark:bg-neutral-700 rounded-md dark:border dark:border-neutral-500">
                                <EmptyState v-if="!comments.data[0]" message="This user has no comments..."/>

                                <ProfileComment
                                    v-for="(comment, index) in comments.data"
                                    :comment="comment"
                                />
                            </div>

                            <div class="mt-4 p-2" v-if="user.posts_count">
                                <Pagination :links="comments.meta.links" v-if="comments.meta.last_page !== 1"/>
                            </div>

                            <hr class="m-3">

                            <h2 class="py-2 dark:text-white text-2xl text-center font-bold">Replies</h2>
                            <div class="dark:bg-neutral-700 rounded-md dark:border dark:border-neutral-500">
                                <EmptyState v-if="!comments.data[0]" message="This user has no comments..."/>

                                <ProfileComment
                                    v-for="(reply, index) in replies.data"
                                    :comment="reply"
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
import { Head, Link } from '@inertiajs/inertia-vue3';
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
