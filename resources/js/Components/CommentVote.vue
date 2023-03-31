<template>
    <div class="w-12 flex flex-col p-3 bg-slate-300 text-center justify-center dark:bg-neutral-900 rounded-l-lg dark:text-white">
        <CommentUpVoteLink :comment_id="comment.id" :class="{'text-red-600 dark:text-red-500': vote.vote == 1 && vote.user_id == $page.props.auth.user.id}" />

        <div class="my-auto mx-auto font-bold "
            :class="{
                'text-red-600 dark:text-red-500': vote.vote == 1 && vote.user_id == $page.props.auth.user.id,
                'text-blue-600 dark:text-blue-500': vote.vote == -1 && vote.user_id == $page.props.auth.user.id,
            }"
        >
            {{ comment.votes }}
        </div>

        <CommentDownVoteLink :comment_id="comment.id" :class="{'text-blue-600 dark:text-blue-500': vote.vote == -1 && vote.user_id == $page.props.auth.user.id}" />
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
