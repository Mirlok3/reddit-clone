<template>
    <guest-layout>
        <template #header>
            <SubredditHeader :subreddit="subreddit" :ifUserSubscribed="ifUserSubscribed" />
        </template>

        <section class="flex flex-col md:flex-row">
            <div class="md:w-9/12 w-full">
                <div class="flex bg-white shadow-md rounded-lg dark:bg-neutral-700 dark:border dark:border-neutral-500">
                    <div>
                        <PostVote :post="post.data" />
                    </div>
                    <div class="w-full">
                        <div class="flex justify-between text-sm mx-3 mt-2 text-gray-500">
                            <div class="flex my-auto">
                                <p class="mr-1 md:flex hidden">Posted by</p>

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-5 h-4 text-green-600 dark:text-green-500" v-if="post.data.user_id == subreddit.user_id">
                                    <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>

                                <Link class="text-gray-700 font-semibold mr-1 dark:text-gray-200 dark:hover:text-indigo-300"
                                      :href="route('profile.show', post.data.username)">
                                    {{ post.data.username }}
                                </Link>
                                <p class="truncate">{{ post.data.created_at }}</p>
                            </div>

                            <!-- Edit and delete -->
                            <EditDelete :editHref="route('subreddits.posts.edit', [subreddit.slug, post.data.slug])"
                                        :deleteHref="route('subreddits.posts.destroy', [subreddit.slug, post.data.slug])"
                                        :id="post.data.user_id" :can_delete="can_delete"
                                        v-if="$page.props.auth.user === null || $page.props.auth.user.id === post.data.user_id || $page.props.auth.user.is_admin || can_delete"
                            />
                        </div>

                        <div class="px-2 mb-2 md:w-12/12 break-words">
                            <h1 class="font-semibold text-3xl text-black dark:text-white">{{ post.data.title }}</h1>
                            <h2 class="text-slate-700 my-2 dark:text-gray-300 whitespace-pre-wrap">{{ post.data.description }}</h2>
                            <div class="scale-100">
                                <PostMedia :post="post.data" />
                            </div>
                            <a :href="post.data.url" class="font-semibold text-blue-500 text-sm hover:text-blue-300">{{ post.data.url }}</a>
                        </div>
                    </div>
                </div>

                <!-- Comments form-->
                <div class="bg-white shadow-lg rounded-lg mt-5 dark:bg-neutral-700 dark:border dark:border-neutral-500 mb-12">
                    <div v-if="$page.props.auth.auth_check">
                        <form class="m-2 p-2" @submit.prevent="submit">
                            <div class="mb-4 w-full rounded-lg border border-gray-400">
                                <div class="flex justify-between bg-neutral-200 rounded-t-lg dark:bg-neutral-900">
                                    <div class="flex my-auto ml-3">
                                        <img :src="'/' + $page.props.auth.user.user_image" alt="" class="w-8 h-8 rounded-full">
                                        <Link class="font-semibold text-slate-700 dark:text-white my-auto dark:hover:text-indigo-300 ml-1.5">
                                            <span class="">{{ $page.props.auth.user.username }}</span>
                                        </Link>
                                    </div>

                                    <BreezeInputError class="my-auto mx-auto pt-3" :message="form.errors.content"/>
                                    <button class="m-1.5 mr-3 px-4 py-2 text-white rounded-full text-sm font-bold bg-indigo-600 font-bold hover:bg-indigo-500 dark:hover:bg-indigo-800">
                                        Comment
                                    </button>
                                </div>

                                <div>
                                    <textarea v-model="form.content" id="comment" placeholder="Say something..." rows="4" autofocus
                                              class="block p-2 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 rounded-b-lg dark:bg-neutral-800 dark:text-white">
                                    </textarea>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>

                    <!-- Comment section -->
                    <ul role="list" class="md:m-4 pb-5">
                        <EmptyState v-if="!comments.data[0]" message="Be the first to comment!"/>

                        <li v-for="(comment, index) in comments.data"  :key="index" class="mb-3 flex bg-gray-200 rounded-xl dark:bg-neutral-800">
                            <Comment :comment="comment" :subreddit="subreddit" :post="post" :comments="comments" :index="index" :can_delete="can_delete"/>
                        </li>

                        <Pagination :links="comments.meta.links" v-if="comments.meta.last_page !== 1"/>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <SubredditSideBar :subreddit="subreddit" :subreddits="subreddits" />
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import PostVote from "@/Components/PostVote.vue";
import SubredditSideBar from "@/Components/SubredditSideBar.vue";
import BreezeInputError from '@/Components/InputError.vue';
import PostMedia from "@/Components/PostMedia.vue";
import EmptyState from "@/Components/EmptyState.vue";
import SubredditHeader from "@/Components/SubredditHeader.vue";
import Pagination from "@/Components/Pagination.vue";
import Comment from "@/Components/Comment.vue";
import EditDelete from "@/Components/EditDelete.vue";

const props = defineProps({
    subreddit: Object,
    subreddits: Object,
    post: Object,
    can_update: Boolean,
    can_delete: Boolean,
    ifUserSubscribed: Number,
    comments: Object,
});

const form = useForm({
    content: "",
});

const submit = () => {
    form.post(
        route("comments.store", [props.subreddit.slug, props.post.data.slug]), {
            onSuccess: () => form.reset("content")
        }
    );
};
</script>
