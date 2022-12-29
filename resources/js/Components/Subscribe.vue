<template>
    <Link class="px-3 py-2 rounded-full bg-white hover:bg-gray-200 text-black mr-6 font-semibold pr-4 flex justify-between"  v-if="ifUserSubscribed"
          :href="route('subreddits.subscribe', subreddit.slug)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>

        Subscribed
    </Link>

    <Link class="px-3 py-2 rounded-full bg-white hover:bg-gray-200 text-black mr-6 font-semibold pr-4" v-else
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
