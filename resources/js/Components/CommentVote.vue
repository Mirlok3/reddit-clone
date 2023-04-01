<template>
    <div class="w-12 flex flex-col p-3 bg-slate-300 text-center justify-center dark:bg-neutral-900 rounded-l-lg dark:text-white">
        <CommentUpVoteLink :comment_id="comment.id" :class="{'text-red-600 dark:text-red-500': comment.commentVotes[0] && comment.commentVotes[0].vote == 1,}" />

        <div class="p-2 my-2 font-bold"
             :class="{
                'text-red-600 dark:text-red-500': comment.commentVotes[0] && comment.commentVotes[0].vote == 1,
                'text-blue-600 dark:text-blue-500': comment.commentVotes[0] && comment.commentVotes[0].vote == -1,
            }"
        >
            {{ comment.votes }}
        </div>

        <CommentDownVoteLink :comment_id="comment.id" :class="{'text-blue-600 dark:text-blue-500': comment.commentVotes[0] && comment.commentVotes[0].vote == -1,}" />
    </div>
</template>

<script setup>
    import CommentUpVoteLink from "./CommentUpVoteLink.vue";
    import CommentDownVoteLink from "./CommentDownVoteLink.vue";

    defineProps({
        comment: Object,
        vote: Object,
    });
</script>
