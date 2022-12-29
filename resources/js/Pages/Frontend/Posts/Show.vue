<template>
    <guest-layout>
        <template #header>
            <div class="flex m-2 justify-between items-center">
                <Link class="flex" :href="route('frontend.subreddits.show', subreddit.slug)">
                    <div class="avatar">
                        <img :src="subreddit.subreddit_image" class="w-12 h-12 rounded-full ring-4 ring-white p-1">
                    </div>
                    <h2 class="font-semibold text-4xl my-auto mx-6 text-white">r/{{ subreddit.name }}</h2>
                </Link>

                <!-- TODO add login modal if the user is not login-->
                <div class="flex justify-end" v-if="$page.props.auth.auth_check">
                    <Link
                        class="px-3 py-2 rounded-full bg-white hover:bg-gray-200 text-black mr-6 font-semibold pr-4"
                        :href="route('subreddits.posts.create', subreddit.slug)">Create a post
                    </Link>
                </div>
            </div>
        </template>

        <section class="flex flex-col md:flex-row m-2 p-2">
            <div class="w-full">
                <div class="flex m-2 bg-white shadow-md rounded-lg dark:bg-neutral-700 border">
                    <div>
                        <PostVote :post="post.data" />
                    </div>
                    <div class="w-full">
                        <div class="flex flexs flex-col justify-between md:flex-row text-sm mx-3 mt-2 text-gray-500">
                            <div>
                                Posted by
<!--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"
                                    v-if="post.data.user_id = subreddit.user_id">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>-->

                                <Link class="text-gray-700 font-semibold mx-1 dark:text-gray-200 dark:hover:text-indigo-300"
                                      :href="route('profile.show', post.data.username)">
                                    {{ post.data.username }}
                                </Link>
                                {{ post.data.created_at }}
                            </div>

                            <!-- Edit and delete -->
                            <div v-if="$page.props.auth.auth_check">
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

                        <div class="px-2 mb-2">
                            <h1 class="font-semibold text-3xl text-black dark:text-white">{{ post.data.title }}</h1>
                            <p class="text-slate-700 my-2 dark:text-gray-300">{{ post.data.description }}</p>
                            <div class="scale-100">
                                <img :src="post.data.post_image">
                            </div>
                            <a :href="post.data.url" class="font-semibold text-blue-500 text-sm hover:text-blue-300">{{ post.data.url }}</a>
                        </div>

                    </div>
                </div>
                <!-- Comments -->
                <div class="m-2 p-2 bg-white shadow-md rounded-lg mt-6 dark:bg-neutral-700 border">
                    <div v-if="$page.props.auth.auth_check">
                        <form class="m-2 p-2" @submit.prevent="submit">
                            <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-300">
                                <div class="flex justify-end bg-slate-200 rounded-t-lg dark:bg-neutral-800">
                                    <button class="m-1.5 mr-3 px-4 py-2 text-white rounded-full text-sm font-bold bg-indigo-600 font-bold hover:bg-indigo-500 dark:hover:bg-indigo-700">
                                        Comment
                                    </button>
                                </div>

                                <div>
                                    <!--TODO: Error message not working-->
                                    <textarea v-model="form.content" id="comment" placeholder="Say something..." rows="4"
                                        class="block p-2 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 rounded-lg">
                                    </textarea>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>

                    <ul role="list" class="m-4">
                        <!--TODO: Profile image and link for name, Add upvotes to comments-->
                        <li v-for="(comment, index) in post.data.comments"  :key="index" class="py-3.5 px-4 mb-3 flex flex-col bg-gray-200 rounded-xl dark:bg-neutral-800">
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                Commented by<span class="font-semibold ml-1 text-slate-700 dark:text-white">{{ comment.username }}</span>
                            </div>

                            <div class="text-slate-600 m-2 border-l-4 border-indigo-500 dark:text-white">
                                <span class="ml-2">{{ comment.content }}</span>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="hidden lg:flex flex-col w-6/12">
                <div class="ml-1 p-2">
                    <div class="shadow-md border rounded-lg dark:text-white">
                        <h2 class="font-semibold text-large p-4 bg-indigo-700 text-white rounded-t-lg">
                            About {{ subreddit.name }}
                        </h2>
                        <p class="p-4 bg-white dark:bg-neutral-700">
                            {{ subreddit.description }}
                        </p>
                        <p class="p-4 bg-white rounded-b-lg dark:bg-neutral-700">
                            <span class="font-bold">Subscribers:</span> {{ subreddit.subscribers }}
                        </p>
                    </div>
                </div>
                <div class="ml-1 p-2 mt-6">
                    <SubredditList :subreddits="subreddits.data" />
                </div>
            </div>
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import PostVote from "@/Components/PostVote.vue";
import SubredditList from "@/Components/SubredditList.vue";

const props = defineProps({
    subreddit: Object,
    subreddits: Object,
    post: Object,
    can_update: Boolean,
    can_delete: Boolean,
});

const form = useForm({
    content: "",
});

const submit = () => {
    form.post(
        route("frontend.posts.comments", [props.subreddit.slug, props.post.data.slug]), {
            onSuccess: () => form.reset("content")
        }
    );
};
</script>
