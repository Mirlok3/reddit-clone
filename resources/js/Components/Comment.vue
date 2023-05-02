<template>
    <!--                            TODO: add share link for comment and post -->
    <CommentVote :comment="comment" type="comments"/>
    <div class="w-full flex flex-col justify-between p-3 break-words">
        <div class="flex justify-between my-auto ">
            <div class="flex my-auto">
                <img :src="'/' + comment.user_image" alt="" class="w-8 h-8 rounded-full">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-4 h-4 text-blue-600 dark:text-blue-500 my-auto md:ml-3 ml-0.5" v-if="comment.username == post.data.username ">
                    <path d="M16.881 4.346A23.112 23.112 0 018.25 6H7.5a5.25 5.25 0 00-.88 10.427 21.593 21.593 0 001.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.592.772-2.468a17.116 17.116 0 01-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0018 11.25c0-2.413-.393-4.735-1.119-6.904zM18.26 3.74a23.22 23.22 0 011.24 7.51 23.22 23.22 0 01-1.24 7.51c-.055.161-.111.322-.17.482a.75.75 0 101.409.516 24.555 24.555 0 001.415-6.43 2.992 2.992 0 00.836-2.078c0-.806-.319-1.54-.836-2.078a24.65 24.65 0 00-1.415-6.43.75.75 0 10-1.409.516c.059.16.116.321.17.483z" />
                </svg>
                <UserRole class="my-auto ml-0.5" :role="comment.role" />

                <Link class="font-semibold text-slate-700 dark:text-white my-auto dark:hover:text-indigo-300 md:ml-1.5 ml-1"
                      :href="route('profile.show', comment.username)">
                    <span class="">{{ comment.username }}</span>
                </Link>
                <span class="my-auto ml-2 text-xs text-gray-500 font-bold truncate">{{ comment.created_at }}</span>
            </div>

        </div>
        <div class="md:m-2 border-l-4 border-indigo-500 flex-col">
            <p class="text-black dark:text-white whitespace-pre-wrap ml-2 mb-2.5">{{ comment.content }}</p>
            <div class="flex">
                <Link :href="route('replies.create', [subreddit.slug, props.post.data.slug, comment.id])"
                      class="font-semibold text-sm bg-blue-500 hover:bg-blue-700 rounded-full text-white p-0.5 px-2.5 my-auto m-2">
                    <span>Reply</span>
                </Link>
                <!-- Comment Edit and delete -->
                <div>
                    <EditDelete :editHref="route('comments.edit', [subreddit.slug, post.data.slug, comment.id])"
                                :deleteHref="route('comments.destroy', [subreddit.slug, post.data.slug, comment.id])"
                                :can_delete="can_delete" :id="comment.user_id"
                                v-if="$page.props.auth.user === null || $page.props.auth.user.id === comment.user_id || $page.props.auth.user.is_admin || can_delete"
                    />
                </div>
            </div>
            <!--Replies -->
            <ul role="list" class="m-2 md:ml-4 border-l-4 border-indigo-500 w-full">
                <li v-for="(reply, jindex) in comments.data[index].replies" :key="jindex" class="flex mb-2">
                    <Reply :comment="comment" :subreddit="subreddit" :post="post" :comments="comments" :index="index" :reply="reply" :can_delete="can_delete"/>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import CommentVote from "@/Components/CommentVote.vue";
import Reply from "@/Components/Reply.vue";
import EditDelete from "@/Components/EditDelete.vue";
import UserRole from "@/Components/UserRole.vue";

const props = defineProps({
    comment: Object,
    subreddit: Object,
    post: Object,
    comments: Object,
    index: Number,
    can_delete: Boolean
});

</script>
