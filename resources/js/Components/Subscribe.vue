<template>
    <Link class="px-3 py-2 rounded-full bg-indigo-500 hover:bg-indigo-700 text-white"
          :href="route('subreddits.subscribe', subreddit.slug)">Subscribe
    </Link>
</template>

<script setup>
    import { Link } from "@inertiajs/inertia-vue3";

    defineProps({
        subreddit: Object,
    });
</script>
