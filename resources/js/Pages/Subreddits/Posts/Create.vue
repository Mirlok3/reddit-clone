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
                <div class="max-w-md mx-auto bg-white m-2 p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="title" value="Title" />
                            <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus
                                autocomplete="title" />
                            <BreezeInputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="url" value="Url" />
                            <BreezeInput id="url" type="text" class="mt-1 block w-full" v-model="form.url" autofocus
                                autocomplete="url" />
                            <BreezeInputError class="mt-2" :message="form.errors.url" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="description" value="Description" />
                            <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                                autofocus autocomplete="description" />
                            <BreezeInputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="post_image" value="Image" />
                            <BreezeInput id="post_image" type="file" class="mt-1 block w-full"
                                @input="form.post_image = $event.target.files[0]"/>
                            <BreezeInputError class="mt-2" :message="form.errors.post_image" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Post
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
    post_image: null,
});

const submit = () => {
    form.post(route("subreddits.posts.store", props.subreddit.slug));
};

</script>
