<template>
    <Link v-if="ifUserSubscribed"
          :href="route('subreddits.subscribe', subreddit.slug)">

        <span class="hidden lg:block mx-auto">Subscribed</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="md:w-6 md:h-6 md:mr-1 w-5 h-5 my-auto mx-1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
    </Link>

    <Link v-else
          :href="route('subreddits.subscribe', subreddit.slug)">

        <span class="hidden md:block mx-auto ml-1">Subscribe</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 my-auto mx-1.5 lg:hidden block">
            <path d="M5.85 3.5a.75.75 0 00-1.117-1 9.719 9.719 0 00-2.348 4.876.75.75 0 001.479.248A8.219 8.219 0 015.85 3.5zM19.267 2.5a.75.75 0 10-1.118 1 8.22 8.22 0 011.987 4.124.75.75 0 001.48-.248A9.72 9.72 0 0019.266 2.5z" />
            <path fill-rule="evenodd" d="M12 2.25A6.75 6.75 0 005.25 9v.75a8.217 8.217 0 01-2.119 5.52.75.75 0 00.298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 107.48 0 24.583 24.583 0 004.83-1.244.75.75 0 00.298-1.205 8.217 8.217 0 01-2.118-5.52V9A6.75 6.75 0 0012 2.25zM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 004.496 0l.002.1a2.25 2.25 0 11-4.5 0z" clip-rule="evenodd" />
        </svg>

    </Link>
</template>

<script setup>
    import { Link } from "@inertiajs/inertia-vue3";

    defineProps({
        subreddit: Object,
        ifUserSubscribed: Number,
    });
</script>
