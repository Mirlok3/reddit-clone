<template>
    <guest-layout>
        <!-- <template #header>
            <div class="flex m-2 justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    r/{{ subreddit.name }}
                </h2>

                <Link v-if="$page.props.auth.auth_check" class="px-3 py-2 rounded bg-indigo-500 hover:bg-indigo-700 text-white"
                :href="route('subreddits.posts.create', subreddit.slug)">Create a post</Link>
            </div>
        </template> -->

        <section class="flex flex-col md:flex-row m-2 p-2">
            <div class="w-full md:w-8/12">
                <div class="m-2 p-2 bg-white">
                    <h2 class="font-semibold text-2xl text-black">
                        <Link :href="route('frontend.subreddits.show', subreddit.slug)">
                            r/{{ subreddit.name }}
                        </Link>
                    </h2>
                </div>
                <div class="m-2 p-2 bg-white ">
                    <div class="flex flex-col justify-between md:flex-row text-sm m-2">
                        <div class="text-sm text-slate-400">
                            Posted by
                            <span class="text-slate-600 ml-1"> {{ post.data.username }}</span>
                        </div>

                        <div v-if="$page.props.auth.auth_check && post.data.owner">
                            <Link :href="route('subreddits.posts.edit', [subreddit.slug, post.data.slug])"
                                class="font-semibold bg-blue-500 hover:bg-blue-700 rounded-md text-white px-4 py-2">
                                Edit
                            </Link>
                            <Link :href="route('subreddits.posts.destroy', [subreddit.slug, post.data.slug])"
                                method="delete" as="button" type="button"
                                class="font-semibold bg-red-500 hover:bg-red-700 rounded-md text-white px-4 py-2 ml-2">
                                Delete
                            </Link>
                        </div>
                    </div>

                    <div class="p-2">
                        <h1 class="font-semibold text-3xl text-black">{{ post.data.title }}</h1>
                        <p class="text-slate-700 my-2">{{ post.data.description }}</p>
                        <a :href="post.data.url" class="font-semibold text-blue-500 text-sm hover:text-blue-300">{{ post.data.url }}</a>
                    </div>
                    <!-- Comments -->
                    <hr>
                    <ul role="list" class="divide-y divide-gray-200 m-2 p-2">
                        <li v-for="(comment, index) in post.data.comments"  :key="index" class="py-4 flex flex-col">
                            <div class="text-sm text-gray-600">
                                Commented by<span class="font-semibold ml-1 text-slate-700">{{ comment.username }}</span>
                            </div>

                            <div class="text-slate-600 m-2 p-2">
                                {{ comment.content }}
                            </div>
                        </li>
                    </ul>
                    <div v-if="$page.props.auth.auth_check">
                        <hr>
                        <form class="m-2 p-2 max-w-md" @submit.prevent="submit">
                            <div class="mt-2">
                                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">Your Comment</label>

                                <textarea v-model="form.content" id="comment" placeholder="Your comment..."
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                                </textarea>
                            </div>

                            <div class="mt-2">
                                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full md:w-4/12 p-4">
                <div class="m-2 p-2 bg-slate-500 text-white">
                    <h2>Latest Subreddits</h2>
                </div>
            </div>
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link, useForm} from "@inertiajs/inertia-vue3";


const  props = defineProps({
    subreddit: Object,
    post: Object,
})

const form = useForm({
    content: ""
});

const submit = () => {
    form.post(
        route("frontend.posts.comments", [props.subreddit.slug, props.post.data.slug]), {
            onSuccess: () => form.reset('content')
        }
    );
};
</script>
