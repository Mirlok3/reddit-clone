<template>
    <guest-layout>
        <template #header>
            <SubredditHeader :subreddit="subreddit" :ifUserSubscribed="ifUserSubscribed" />
        </template>

        <section class="flex flex-col md:flex-row">
            <div class="md:w-9/12 w-full">
                <div class="flex bg-white shadow-md rounded-lg dark:bg-neutral-700 dark:border-2 dark:border-neutral-500">
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
                            <div v-if="$page.props.auth.auth_check" class="mr-12 md:mr-0">
                                <Link :href="route('subreddits.posts.edit', [subreddit.slug, post.data.slug])" v-if="can_update"
                                    class="font-semibold bg-blue-500 hover:bg-blue-700 rounded-full text-white px-4 py-1">
                                    Edit
                                </Link>
                                <Link :href="route('subreddits.posts.destroy', [subreddit.slug, post.data.slug])" v-if="can_delete"
                                    method="delete" as="button" type="button"
                                    class="font-semibold bg-red-500 hover:bg-red-700 rounded-full text-white px-4 py-1 ml-2">
                                    Delete
                                </Link>
                            </div>
                        </div>

                        <div class="px-2 mb-2 w-10/12 break-words">
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
                <div class="bg-white shadow-md rounded-lg mt-5 dark:bg-neutral-700 dark:border-2 dark:border-neutral-500 mb-12">
                    <div v-if="$page.props.auth.auth_check">
                        <form class="m-2 p-2" @submit.prevent="submit">
                            <div class="mb-4 w-full rounded-lg border border-gray-400">
                                <div class="flex justify-between bg-gray-400 rounded-t-lg dark:bg-neutral-900">
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
                    <ul role="list" class="m-4">
                        <EmptyState v-if="!post.data.comments[0]" message="Be the first to comment!"/>
                        <!--TODO: Add upvotes to comments, Add replies-->
                        <li v-for="(comment, index) in post.data.comments"  :key="index" class="py-3.5 px-4 mb-3 flex flex-col bg-gray-200 rounded-xl dark:bg-neutral-800">
<!--                            TODO: add share link for comment a post and fix edit and delete buttons for mobile view-->
                            <div class="text-sm text-gray-600 dark:text-gray-300  md:ml-3 flex justify-between">
                                <div class="flex my-auto">
                                    <img :src="'/' + comment.user_image" alt="" class="w-8 h-8 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-4 h-4 text-blue-600 dark:text-blue-500 my-auto ml-3" v-if="comment.username == post.data.username ">
                                        <path d="M16.881 4.346A23.112 23.112 0 018.25 6H7.5a5.25 5.25 0 00-.88 10.427 21.593 21.593 0 001.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.592.772-2.468a17.116 17.116 0 01-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0018 11.25c0-2.413-.393-4.735-1.119-6.904zM18.26 3.74a23.22 23.22 0 011.24 7.51 23.22 23.22 0 01-1.24 7.51c-.055.161-.111.322-.17.482a.75.75 0 101.409.516 24.555 24.555 0 001.415-6.43 2.992 2.992 0 00.836-2.078c0-.806-.319-1.54-.836-2.078a24.65 24.65 0 00-1.415-6.43.75.75 0 10-1.409.516c.059.16.116.321.17.483z" />
                                    </svg>
                                    <Link class="font-semibold text-slate-700 dark:text-white my-auto dark:hover:text-indigo-300 ml-1.5"
                                          :href="route('profile.show', comment.username)">
                                        <span class="">{{ comment.username }}</span>
                                    </Link>
                                    <span class="my-auto ml-2 text-xs text-gray-500 font-bold">{{ comment.created_at }}</span>
                                </div>
                                <!-- Edit and delete TODO: edit and create on the same page -->
                                <div v-if="$page.props.auth.auth_check" class="flex">
                                    <Link :href="route('comments.edit', [subreddit.slug, props.post.data.slug, comment.id])"
                                          v-if="$page.props.auth.user.id === comment.user_id"
                                          class="font-semibold bg-blue-500 hover:bg-blue-700 rounded-full text-white px-4 md:py-1 my-auto">
                                        Edit
                                    </Link>
                                    <Link :href="route('comments.destroy', [props.subreddit.slug, props.post.data.slug, comment.id])"
                                          method="delete" as="button" type="button" v-if="$page.props.auth.user.id === comment.user_id || $page.props.auth.user.is_admin"
                                          class="font-semibold bg-red-500 hover:bg-red-700 rounded-full text-white px-4 md:py-1 ml-2 my-auto">
                                        Delete
                                    </Link>
                                </div>
                            </div>

                            <div class="m-2 border-l-4 border-indigo-500">
                                <p class="text-slate-600 dark:text-white whitespace-pre-wrap ml-2">{{ comment.content }}</p>
                            </div>
                        </li>
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

const props = defineProps({
    subreddit: Object,
    subreddits: Object,
    post: Object,
    can_update: Boolean,
    can_delete: Boolean,
    ifUserSubscribed: Number,
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
