<template>
    <Head title="Replying to a Comment."></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-white">
                <h2 class="text-xl font-semibold leading-tight text-white">
                    Reply to a comment.
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="shadow-md max-w-3xl mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg dark:text-white">
                    <form class="m-1" @submit.prevent="submit">
                        <div class="w-full rounded-lg border border-gray-400 bg-neutral-200 dark:bg-neutral-900">
                            <h1 class="font-bold text-lg p-2">Reply to:</h1>
                            <div class="flex-col justify-between p-3 break-words bg-neutral-100 dark:bg-neutral-800 border-b-2">
                                <div class="flex justify-between my-auto">
                                    <div class="flex">
                                        <img :src="'/' + creator[0].user_image" alt="" class="w-8 h-8 rounded-full">
                                        <Link class="font-semibold text-slate-700 dark:text-white my-auto dark:hover:text-indigo-300 md:ml-1.5 ml-1"
                                              :href="route('profile.show', creator[0].username)">
                                            <span class="">{{ creator[0].username }}</span>
                                        </Link>
                                    </div>
                                </div>
                                <div class="m-2 border-l-4 border-indigo-500 flex-col">
                                    <p class="text-black dark:text-white whitespace-pre-wrap ml-2">{{ comment.content }}</p>
                                </div>
                            </div>

                            <div>
                                <textarea v-model="form.content" id="comment" placeholder="Say something..." rows="8" autofocus
                                          class="block p-4 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 dark:bg-neutral-800 dark:text-white">
                                </textarea>
                            </div>

                            <div class="flex justify-end bg-neutral-200 rounded-b-lg dark:bg-neutral-900 p-2">
                                <BreezeButton class="m-1.5 mr-3 px-4 py-2 text-white rounded-full text-sm font-bold bg-indigo-600 font-bold hover:bg-indigo-500 dark:hover:bg-indigo-800"
                                              :class="{ 'opacity-25': form.processing }"
                                              :disabled="form.processing">
                                    Reply
                                </BreezeButton>
                            </div>
                            <BreezeInputError class="mt-2" :message="form.errors.content" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInputError from '@/Components/InputError.vue';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    comment: Object,
    creator: Object,
    post: String,
    subreddit_slug: String,
    errors: Object,
});

const form = useForm({
    content: '',
});

const submit = () => {
    form.post(route("replies.store", [props.subreddit_slug, props.post.slug, props.comment.id]));
};

</script>
