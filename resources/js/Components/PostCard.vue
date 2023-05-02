<template>
    <Link :href="route('frontend.subreddits.posts.show', [subreddit, post.slug])"
        class="mb-4 flex rounded-lg border border-gray-200 bg-white shadow-md dark:border dark:border-neutral-500 dark:bg-neutral-700 dark:text-white">
        <div class="mr-3">
            <PostVote :post="post"/>
        </div>

        <div class="w-11/12 flex flex-col justify-evenly">
            <div class="mx-3 mt-2 flex truncate text-sm tracking-tight text-gray-500 dark:text-gray-400">
                <Link :href="route('frontend.subreddits.show', subreddit)" class="mr-2 font-semibold text-neutral-900 hover:text-indigo-700 dark:text-white">
                    <div class="dark:hover:text-indigo-300">
                        r/{{ subreddit }}
                    </div>
                </Link>

                <span class="mr-1">Posted by</span>
                <UserRole class="pb-0.5" :role="post.role" />

                <Link class="mr-1 font-semibold text-gray-700 hover:text-indigo-700 dark:text-gray-200 dark:hover:text-indigo-300"
                      :href="route('profile.show', post.username)">
                    {{ post.username }}
                </Link>
                {{ post.created_at }}
            </div>

            <p class="mx-2 my-2 truncate text-2xl font-bold text-gray-900 hover:text-indigo-700 dark:text-white dark:hover:text-indigo-300">
                {{ post.title }}
            </p>

            <div class="mr-2 scale-100">
                <PostMedia :post="post"/>
            </div>

            <p class="m-2 truncate font-normal text-gray-700 dark:text-white">
                {{ post.description }}
            </p>

            <div class="m-1 flex p-2 text-sm font-semibold text-slate-500 hover:text-slate-700 dark:text-white dark:hover:text-indigo-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>

                <p class="ml-2 mt-0.5">{{ post.comments_count }} comments</p>
            </div>
        </div>
    </Link>
</template>

<script setup>
    import {Link} from "@inertiajs/inertia-vue3"
    import PostVote from "./PostVote.vue"
    import PostMedia from "./PostMedia.vue";
    import UserRole from "./UserRole.vue";

    defineProps({
        post: Object,
        subreddit: String,
    });
</script>
