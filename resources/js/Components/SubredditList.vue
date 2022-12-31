<template>
    <div class="w-full bg-white shadow-md border rounded-lg dark:bg-neutral-700 dark:border-2 dark:border-neutral-500">
        <h2 class="font-semibold text-large p-4 bg-indigo-700 text-white rounded-t-lg">Top Subreddits</h2>

        <ul role="list" class="divide-y divide-slate-300 p-4">
            <li class="py-3.5 sm:py-3.5" v-for="subreddit in subreddits" :key="subreddit.id">
                <div class="flex items-center space-x-4 text-center">
                    <div class="avatar">
                        <img :src="subreddit.subreddit_image" class="w-10 h-10 rounded-full ring-2 ring-indigo-700 dark:ring-white p-0.5">
                    </div>

                    <Link :href="route('frontend.subreddits.show', subreddit.slug)"
                          class="text-slate-800 font-semibold text-lg dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-300">
                        {{ subreddit.name }}
                    </Link>

                    <div class="text-sm dark:text-gray-300">
                        {{ subreddit.posts_count }} posts
                    </div>
                </div>
            </li>
        </ul>

    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
    subreddits: Object,
})
</script>
