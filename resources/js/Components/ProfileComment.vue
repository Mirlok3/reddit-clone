<template>
    <Link :href="route('frontend.subreddits.posts.show', [comment.subreddit_slug, comment.post_slug])">
        <div class="shadow-md flex justify-between bg-neutral-200 dark:hover:bg-opacity-90 hover:bg-opacity-60 dark:bg-neutral-800 md:m-1.5 my-3 rounded-md">
            <CommentVote :comment="comment" :type="type"/>
            <div class="w-full break-words p-3">
                <div class="my-auto flex flex-col justify-between">
                    <div class="my-auto flex">
                        <img :src="'/' + comment.user_image" alt="" class="h-8 w-8 rounded-full">

                        <span class="my-auto ml-1 font-semibold text-slate-700 dark:text-white dark:hover:text-indigo-300 md:ml-1.5">
                            {{ comment.username }}
                        </span>

                        <span class="my-auto ml-2 truncate text-xs font-bold text-gray-500">
                            {{ comment.created_at }}
                        </span>
                    </div>
                    <div class="flex-col border-l-4 border-indigo-500 md:m-2">
                        <p class="ml-2 whitespace-pre-wrap text-black dark:text-white mb-2.5">{{ comment.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import CommentVote from "@/Components/CommentVote.vue";

const props = defineProps({
    comment: Object,
    type: String,
});

console.log(props.comment)

</script>
