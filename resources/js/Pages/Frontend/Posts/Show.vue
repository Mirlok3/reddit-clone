<template>
    <guest-layout>
        <template #header>
            <div class="flex m-2 justify-between items-center">
                <Link class="flex" :href="route('frontend.subreddits.show', subreddit.slug)">
                    <div class="avatar">
                        <img :src="subreddit.subreddit_image" class="w-12 h-12 rounded-full ring-4 ring-indigo-600">
                    </div>
                    <h2 class="font-semibold text-4xl text-gray-800 my-auto mx-6">r/{{ subreddit.name }}</h2>
                </Link>


                <Link v-if="$page.props.auth.auth_check" class="px-3 py-2 rounded bg-indigo-500 hover:bg-indigo-700 text-white"
                :href="route('subreddits.posts.create', subreddit.slug)">Create a post</Link>
            </div>
        </template>

        <section class="flex flex-col md:flex-row m-2 p-2">
            <div class="w-full">
                <div class="flex m-2 bg-white shadow-md rounded-lg">
                    <div>
                        <PostVote :post="post.data" />
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col justify-between md:flex-row text-sm mx-3 mt-2 text-gray-500">
                            <div>
                                Posted by
                                <span class="text-gray-700 font-semibold mx-1"> {{ post.data.username }}</span>
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

                        <div class="px-2">
                            <h1 class="font-semibold text-3xl text-black">{{ post.data.title }}</h1>
                            <p class="text-slate-700 my-2">{{ post.data.description }}</p>
                            <a :href="post.data.url" class="font-semibold text-blue-500 text-sm hover:text-blue-300">{{ post.data.url }}</a>
                        </div>

                    </div>
                </div>
                <!-- Comments -->
                <div class="m-2 p-2 bg-white shadow-md rounded-lg mt-6">
                    <div v-if="$page.props.auth.auth_check">
                        <form class="m-2 p-2" @submit.prevent="submit">
                            <div class="mb-4 w-full bg-gray-50 rounded-lg border border-black">
                                <div class="flex justify-end bg-slate-200 rounded-t-lg">
                                    <button class="m-1.5 mr-3 px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded-full text-sm font-bold">
                                        Comment
                                    </button>
                                </div>

                                <div>
                                    <textarea v-model="form.content" id="comment" placeholder="Say something..." rows="4"
                                        class="block p-2 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 rounded-lg">
                                    </textarea>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>

                    <ul role="list" class="divide-y divide-gray-200 m-2 p-2">
                        <li v-for="(comment, index) in post.data.comments"  :key="index" class="py-4 flex flex-col">
                            <div class="text-sm text-gray-600">
                                Commented by<span class="font-semibold ml-1 text-slate-700">{{ comment.username }}</span>
                            </div>

                            <div class="text-slate-600 m-2 p-2">
                                {{ comment.content }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="hidden lg:flex flex-col w-6/12">
                <div class="m-2 p-2">
                    <div class="shadow-md">
                        <h2 class="font-semibold text-large p-4 bg-indigo-700 text-white rounded-t-lg">
                            About {{ subreddit.name }}
                        </h2>
                        <p class="p-4 bg-white rounded-b-lg">
                            {{ subreddit.description }}
                        </p>
                    </div>
                </div>
                <div class="m-2 p-2 mt-6">
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
