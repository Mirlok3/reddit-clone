<template>
    <Head title="Creating a Post"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Create a post for r/{{ subreddit.name }}.
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="dark:border dark:border-neutral-500 max-w-3xl mx-auto bg-white m-2 p-6 dark:bg-neutral-600 rounded-lg dark:text-white">
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="title" value="Title" class="dark:text-white"/>
                            <BreezeInput id="title" type="text" class="mt-1 block w-1/2 dark:bg-neutral-800 border-gray-400" v-model="form.title" autofocus
                                         autocomplete="title" />
                            <BreezeInputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <BreezeLabel for="description" value="Description" class="mt-4 dark:text-white"/>
                        <div class="w-full bg-gray-50 rounded-lg border border-gray-400 ">
                            <div class="flex bg-slate-300 rounded-t-lg p-2 text-sm text-gray-600 pr-4 dark:bg-neutral-900">
                                <BreezeLabel for="post_file">
                                    <div class="flex justify-between items-center hover:text-gray-800 hover:font-semibold cursor-pointer">
                                        <div class="mr-16 ml-3">
                                            <BreezeInput id="post_file" type="file" class="mt-1 block w-1/2 file:hidden shadow-none dark:text-white"
                                                         @input="form.post_file = $event.target.files[0]" accept=".jpg, .jpeg, .webp, .png, .mp4, .gif, .webm, .ogg" />

                                        </div>
                                        <div class="flex">
                                            <p class="mr-3 mt-0.5 dark:text-white">Add a Picture... <span class="text-xs text-gray-500">(jpg, jpeg, webp, png, mp4, gif, webm, ogg)</span> </p>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 dark:text-white mx-auto my-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </BreezeLabel>
                            </div>

                            <div>
                                <textarea id="description" type="text" v-model="form.description" placeholder="Say something..."
                                          rows="4" autofocus autocomplete="description"
                                          class="block p-2 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 rounded-b-lg dark:text-white dark:bg-neutral-800">
                                </textarea>
                            </div>
                        </div>
                        <BreezeInputError class="mt-2" :message="form.errors.description"/>
                        <BreezeInputError class="mt-2" :message="form.errors.post_file" />

                        <div class="mt-4">
                            <BreezeLabel for="url" value="Url" class="dark:text-white" />
                            <BreezeInput id="url" type="text" class="mt-1 block w-full dark:bg-neutral-800 border-gray-400" v-model="form.url" autofocus
                                         autocomplete="url" />
                            <BreezeInputError class="mt-2" :message="form.errors.url" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                          :disabled="form.processing">
                                Create
                            </BreezeButton>
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
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    subreddit: Object,
    errors: Object,
});

const form = useForm({
    title: "",
    description: "",
    url: "",
    post_file: null,
});

const submit = () => {
    form.post(route("subreddits.posts.store", props.subreddit.slug));
};

</script>
