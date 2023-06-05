<template>
    <Head title="Editing a Comment"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-white">
                <h2 class="text-xl font-semibold leading-tight text-white">
                    Edit your comment.
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="shadow-md dark:border dark:border-neutral-500 max-w-3xl mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg dark:text-white">
                    <form class="m-1" @submit.prevent="submit">
                        <div class="w-full rounded-lg border border-gray-400">
                            <div class="flex justify-between bg-neutral-200 rounded-t-lg dark:bg-neutral-900 p-2">
                                <div class="flex my-auto ml-3">
                                    Edit a comment from a post in r/{{ sub_name.name }}
                                </div>
                                <BreezeButton class="m-1.5 mr-3 px-4 py-2 text-white rounded-full text-sm font-bold bg-indigo-600 font-bold hover:bg-indigo-500 dark:hover:bg-indigo-800"
                                              :class="{ 'opacity-25': form.processing }"
                                              :disabled="form.processing">
                                    Update
                                </BreezeButton>
                            </div>

                            <div>
                                <textarea v-model="form.content" id="comment" placeholder="Say something..." rows="8" autofocus
                                          class="block p-4 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 rounded-b-lg dark:bg-neutral-800 dark:text-white">
                                </textarea>
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
import { Link, Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    comment: Object,
    post: String,
    subreddit_slug: String,
    sub_name: Object,
    errors: Object,
});

const form = useForm({
    content: props.comment?.content,
    _method: 'put',
});

const submit = () => {
    form.post(route("comments.update", [props.subreddit_slug, props.post, props.comment.id]));
};

</script>
