<template>
    <Head title="Create a Subreddit"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a post for r/{{ subreddit.name }}.
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-xl mx-auto bg-white m-2 p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="title" value="Title" />
                            <BreezeInput id="title" type="text" class="mt-1 block w-1/2" v-model="form.title" autofocus
                                autocomplete="title" />
                            <BreezeInputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mt-4 w-full bg-gray-50 rounded-lg border border-gray-300">
                            <div class="flex bg-slate-200 rounded-t-lg p-2 text-sm text-gray-600 pr-4">
                                <BreezeLabel for="post_image">
                                    <div class="flex justify-between items-center hover:text-gray-800 hover:font-semibold cursor-pointer">
                                        <div class="mr-16 ml-3">
                                            <BreezeInput id="post_image" type="file" class="mt-1 block w-1/2 file:hidden shadow-none"
                                                         @input="form.post_image = $event.target.files[0]"/>

                                        </div>
                                        <p class="mr-3 mt-0.5">Add a Picture... </p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                </BreezeLabel>
                            </div>

                            <div>
                                <BreezeLabel for="description"/>
                                <textarea id="description" type="text" v-model="form.description" placeholder="Say something..."
                                          rows="4" autofocus autocomplete="description"
                                          class="block p-2 w-full text-sm text-gray-800 bg-white border-0 focus:ring-0 rounded-lg"/>
                            </div>
                        </div>
                        <BreezeInputError class="mt-2" :message="form.errors.description"/>
                        <BreezeInputError class="mt-2" :message="form.errors.post_image" />

                        <div class="mt-4">
                            <BreezeLabel for="url" value="Url" />
                            <BreezeInput id="url" type="text" class="mt-1 block w-full" v-model="form.url" autofocus
                                         autocomplete="url" />
                            <BreezeInputError class="mt-2" :message="form.errors.url" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Update
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
    post: Object,
    subreddit: Object,
    errors: Object,
});

const form = useForm({
    title: props.post?.title,
    description: props.post?.description,
    post_image: props.post?.post_image,
    url: props.post?.url,
    _method: 'put',
});

const submit = () => {
    form.post(route("subreddits.posts.update", [props.subreddit.slug, props.post.slug]));
};

</script>
