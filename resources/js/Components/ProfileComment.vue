<template>
    <Link :href="route('frontend.subreddits.posts.show', [comment.subreddit_slug, comment.post_slug])">
        <div class="shadow-md flex justify-between bg-neutral-200 hover:bg-neutral-300 dark:bg-neutral-800 md:m-1.5 my-3 rounded-md">
            <CommentVote :comment="comment" type="comments"/>
            <div class="w-full p-3 break-words">
                <div class="flex flex-col justify-between my-auto ">
                    <div class="flex my-auto">
                        <img :src="'/' + comment.user_image" alt="" class="w-8 h-8 rounded-full">

                        <span class="font-semibold text-slate-700 dark:text-white my-auto dark:hover:text-indigo-300 md:ml-1.5 ml-1">
                            {{ comment.username }}
                        </span>

                        <span class="my-auto ml-2 text-xs text-gray-500 font-bold truncate">
                            {{ comment.created_at }}
                        </span>
                    </div>
                    <div class="md:m-2 border-l-4 border-indigo-500 flex-col">
                        <p class="text-black dark:text-white whitespace-pre-wrap ml-2 mb-2.5">{{ comment.content }}</p>
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
});

</script>
