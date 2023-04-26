<template>
    <Head title="Creating a Post"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">
                Create a post <span v-if="subreddit.id">for r/{{ subreddit.name }}</span>
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <div class="m-2 mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-md dark:border dark:border-neutral-500 dark:bg-neutral-600 dark:text-white">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div>
                            <BreezeLabel for="title" value="Title" class="dark:text-white"/>
                            <BreezeInput id="title" type="text"
                                         class="mt-1 block w-1/2 border-gray-400 dark:bg-neutral-800"
                                         v-model="form.title" autofocus
                                         autocomplete="title"/>
                            <BreezeInputError class="mt-2" :message="form.errors.title"/>
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="subs" value="Subreddit" class="dark:text-white"/>
                            <select class="mt-1 block w-1/2 rounded-md border-gray-400 dark:bg-neutral-800" id="sub" v-model="form.sub">
                                <option :value="subreddit" selected>
                                    <div v-if="subreddit.id">{{ subreddit.name }} (Default)</div>
                                    <div v-else>Pick a subreddit...</div>
                                </option>
                                <option v-for="sub in subs" :value="sub">
                                    {{ sub.name }}
                                </option>
                            </select>
                            <BreezeInputError class="mt-2" :message="form.errors.sub"/>
                        </div>

                        <BreezeLabel for="description" value="Description" class="mt-4 dark:text-white"/>
                        <div class="w-full rounded-lg border border-gray-400 bg-gray-50">
                            <div class="flex flex-col rounded-t-lg bg-slate-300 p-2 pr-4 text-sm text-gray-600 dark:bg-neutral-900">
                                <BreezeLabel for="post_file">
                                    <div class="flex cursor-pointer items-center justify-between hover:text-gray-800">
                                        <div class="my-auto truncate">
                                            <BreezeInput id="post_file[]" type="file" class="font-bold shadow-none file:hidden dark:text-white" multiple
                                                         @input="form.post_file = $event.target.files[0]" accept=".jpg, .jpeg, .webp, .png, .mp4, .gif, .webm, .ogg" />

                                        </div>
                                        <div class="my-auto flex flex-row">
                                            <p class="my-auto mr-3 dark:text-white">Add a Picture... <span class="text-xs text-gray-500">(jpg, jpeg, webp, png, mp4, gif, webm, ogg)</span> </p>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto my-auto h-7 w-7 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </BreezeLabel>
                            </div>

                            <div>
                                <textarea id="description" type="text" v-model="form.description" placeholder="Say something..."
                                          rows="4" autocomplete="description"
                                          class="block w-full rounded-b-lg border-0 bg-white p-2 text-sm text-gray-800 focus:ring-0 dark:text-white dark:bg-neutral-800">
                                </textarea>
                            </div>
                        </div>
                        <BreezeInputError class="mt-2" :message="form.errors.description"/>
                        <BreezeInputError class="mt-2" :message="form.errors.post_file" />

                        <div class="mt-4">
                            <BreezeLabel for="url" value="Url" class="dark:text-white" />
                            <BreezeInput id="url" type="text" class="mt-1 block w-full border-gray-400 dark:bg-neutral-800" v-model="form.url"
                                         autocomplete="url" />
                            <BreezeInputError class="mt-2" :message="form.errors.url" />
                        </div>


                        <div class="mt-4 flex items-center justify-end">
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
    subs: Object,
    errors: Object,
});

const form = useForm({
    title: "",
    description: "",
    url: "",
    sub: props.subreddit,
    post_file: null,
});


const submit = () => {
    if (!form.sub.id) {
        form.errors.sub = "Please pick a subreddit!";
    }
    form.post(route("subreddits.posts.store", form.sub.slug));
};

</script>
