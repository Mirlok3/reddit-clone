<template>
    <Link :href="route('frontend.subreddits.posts.show', [subreddit, post.slug])"
        class="flex bg-white rounded-lg border border-gray-200 shadow-md mb-4 dark:bg-neutral-700 dark:text-white dark:border dark:border-neutral-500">
        <div class="mr-3">
            <PostVote :post="post"/>
        </div>

        <div class="w-9/12">
            <div class="flex mx-3 mt-2 text-sm text-gray-500 dark:text-gray-400 truncate tracking-tight">
                <Link :href="route('frontend.subreddits.show', subreddit)" class="font-semibold mr-2 hover:text-indigo-700 text-neutral-900 dark:text-white">
                    <div class="dark:hover:text-indigo-300">
                        r/{{ subreddit }}
                    </div>
                </Link>

                <span class="mr-1">Posted by</span>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-5 h-4 text-green-600 dark:text-green-500" v-if="post.user_id == post.subreddit_mod">
                    <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>

                <Link class="text-gray-700 font-semibold mr-1 dark:text-gray-200 dark:hover:text-indigo-300" :href="route('profile.show', post.username)">{{ post.username }}</Link>
                {{ post.created_at }}
            </div>

            <p class="my-2 mx-2 text-2xl font-bold text-gray-900 hover:text-indigo-700 dark:text-white dark:hover:text-indigo-300 truncate">
                {{ post.title }}
            </p>

            <div class="scale-100 mr-2">
                <PostMedia :post="post"/>
            </div>

            <p class="m-2 font-normal text-gray-700 dark:text-white truncate">
                {{ post.description }}
            </p>

            <div class="flex m-1 p-2 text-sm text-slate-500 font-semibold hover:text-slate-700 dark:text-white dark:hover:text-indigo-300">
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
    import PostMedia from "./PostMedia.vue";

    defineProps({
        post: Object,
        subreddit: String,
    });
</script>
