<template>
    <div class="w-full bg-white shadow-md border rounded-lg">
        <h2 class="font-semibold text-large p-4 bg-indigo-700 text-white rounded-t-lg">Top Subreddits</h2>

        <ul role="list" class="divide-y divide-slate-300 p-4">
            <li class="py-3 sm:py-4" v-for="subreddit in subreddits" :key="subreddit.id">
                <div class="flex items-center space-x-4">

                    <Link :href="route('frontend.subreddits.show', subreddit.slug)" class="text-slate-800 font-semibold truncate text-sm">
                        {{ subreddit.name }}
                    </Link>

                    <div>
                        Post({{ subreddit.posts_count }})
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
