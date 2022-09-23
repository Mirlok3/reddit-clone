<template>
    <guest-layout>
        <div class="flex justify-end m-2 p-2">
            <Link v-if="$page.props.auth.auth_check" class="px-3 py-4 rounded bg-indigo-500 hover:bg-indigo-700 text-white"
            :href="route('subreddits.posts.create', subreddit.slug)">Create a post</Link>
        </div>
        <h1>r/{{ subreddit.name }}</h1>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    subreddit: Object(),
})
</script>
