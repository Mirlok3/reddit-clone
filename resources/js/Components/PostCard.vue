<template>
    <Link :href="route('frontend.subreddits.posts.show', [subreddit, post.slug])"
        class="max-w-4xl flex bg-white rounded-lg border border-gray-200 shadow-md mt-4">

        <div class="mr-3">
            <PostVote :post="post"/>
        </div>
        <div>
            <div class="flex  mx-3 mt-2 text-sm">
                <Link  :href="route('frontend.subreddits.show', subreddit)" class="font-semibold mr-3 hover:text-indigo-700">
                    r/{{ subreddit }}
                </Link>

                <div class="flex text-gray-500">
                    Posted by <span class="text-gray-700 font-semibold mx-1">{{ post.username }}</span>
                    <!-- TODO moderator and poster badge -->
                    {{ post.created_at }}
                </div>
            </div>

            <div>
                <h5 class="my-2 mx-2 text-2xl font-bold tracking-tight text-gray-900 hover:text-indigo-700">{{ post.title }}</h5>
            </div>

            <div class="scale-100">
                <img :src="post.post_image">
            </div>
            <p class="my-2 mx-2 max-w-2xl font-normal text-gray-700 truncate overflow-ellipsis">{{ post.description }}</p>

            <div class="flex m-1 p-2 text-sm text-slate-500 font-semibold hover:text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>

                <p class="mt-0.5 ml-2">{{ post.comments_count }} comments</p>
            </div>
        </div>
    </Link>
</template>

<script setup>
    import {Link} from "@inertiajs/inertia-vue3"
    import PostVote from "./PostVote.vue"

    defineProps({
        post: Object,
        subreddit: String,
    });
</script>
