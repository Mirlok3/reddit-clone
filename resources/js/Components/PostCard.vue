<template>
    <div class=" max-w-4xl flex bg-white rounded-lg border border-gray-200 shadow-md mt-4">
        <div class="mr-3">
            <PostVote :post="post"/>
        </div>
        <div>
            <div class="flex m-2 p-2 text-sm">
                <span class="font-semibold mr-3 hover:text-indigo-700">r/{{ subreddit }}</span>

                <div class="flex">
                    Posted by <span class="font-semibold mx-1">{{ post.username }}</span>
                </div>
            </div>

            <Link :href="route('frontend.subreddits.posts.show', [subreddit, post.slug])">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:text-indigo-700">{{ post.title }}</h5>
            </Link>

            <p class="mb-3 font-normal text-gray-700">{{ post.description }}</p>

            <div class="flex m-2 p-2">
                <p class="mr-4 p-2">Comments({{ post.comments_count }})</p>
                <Link :href="route('frontend.subreddits.posts.show', [subreddit, post.slug])"
                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                    Read More

                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" strokeWidth={1.5} stroke="currentColor" class="ml-2 mr-1 w-4 h-4">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" />
                    </svg>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {Link} from "@inertiajs/inertia-vue3"
    import PostVote from "./PostVote.vue"

    defineProps({
        post: Object,
        subreddit: String,
    });
</script>
