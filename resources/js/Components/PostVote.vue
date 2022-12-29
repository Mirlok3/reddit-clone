<template>
    <div class="w-12 h-full flex flex-col p-3 bg-slate-300 text-center justify-center dark:bg-neutral-900 rounded-l-lg dark:text-white">
        <UpVoteLink :slug="post.slug" :class="{'text-red-600 dark:text-red-500': post.postVotes[0] && post.postVotes[0].vote == 1,}" />

        <div class="p-2 my-2 font-bold"
            :class="{
                'text-red-600 dark:text-red-500': post.postVotes[0] && post.postVotes[0].vote == 1,
                'text-blue-600 dark:text-blue-500': post.postVotes[0] && post.postVotes[0].vote == -1,
            }"
        >
            {{ post.votes }}
        </div>

        <DownVoteLink :slug="post.slug" :class="{'text-blue-600 dark:text-blue-500': post.postVotes[0] && post.postVotes[0].vote == -1,}" />
    </div>
</template>

<script setup>
    import { Link } from "@inertiajs/inertia-vue3";
    import UpVoteLink from "./UpVoteLink.vue";
    import DownVoteLink from "./DownVoteLink.vue";

    defineProps({
        post: Object,
    });
</script>
