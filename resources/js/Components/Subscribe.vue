<template>
    <Link class="px-3 py-2 rounded-full bg-indigo-800 hover:bg-indigo-700 text-white" v-if="ifUserSubscribed"
          :href="route('subreddits.subscribe', subreddit.slug)">
        Subscribed
    </Link>

    <Link class="px-3 py-2 rounded-full bg-indigo-500 hover:bg-indigo-700 text-white" v-else
          :href="route('subreddits.subscribe', subreddit.slug)">
        Subscribe
    </Link>
</template> <!--TODO add svgs-->

<script setup>
    import { Link } from "@inertiajs/inertia-vue3";

    defineProps({
        subreddit: Object,
        ifUserSubscribed: Boolean,
    });
</script>
