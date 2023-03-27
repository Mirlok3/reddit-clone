<template>
    <guest-layout>
        <template #header>
            <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8" :style="'background-color:' + subreddit.color + ';'" ref="element">
                <div class="flex justify-between items-center mx-auto max-w-6xl">
                    <Link class="flex" :href="route('frontend.subreddits.show', subreddit.slug)">
                        <div class="avatar">
                            <img :src="subreddit.subreddit_image" class="md:w-14 md:h-14 rounded-full border-2 p-1 w-10 h-10" :class="'border-' + colorInvert">
                        </div>
                        <h2 class="font-semibold md:text-4xl my-auto mx-6 text-white text-xl" :class="'text-' + colorInvert">r/{{ subreddit.name }}</h2>
                    </Link>

                    <div class="flex justify-end" v-if="$page.props.auth.auth_check">
                        <Link class="md:px-3 md:py-2 rounded-full bg-white hover:bg-gray-200 md:mr-6 font-semibold border-4"
                              :href="route('subreddits.posts.create', subreddit.slug)" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-5 h-5 mx-1.5 lg:hidden block my-1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                               <span class="hidden lg:block mx-auto" :class="'text-' + !colorInvert">Create a post</span>

                        </Link>
                        <Subscribe :subreddit="subreddit" :ifUserSubscribed="ifUserSubscribed"
                                   :class="'text-' + !colorInvert"
                                   class="md:px-3 md:py-2 rounded-full bg-white hover:bg-gray-200 text-black md:mr-6 font-semibold md:pr-4 p-1 pt-1.5 mr-1 flex justify-between border-4"
                        />
                    </div>
                </div>
            </div>
        </template>

        <section class="md:flex md:flex-row md:m-2 md:p-2">
            <div class="md:w-9/12 sm:w-full">
                <div v-if="postCount == 0" class="font-semibold text-2xl text-gray-400 p-4 flex items-center flex-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                    <h2>There is nothing here....</h2>
                    <h2>Post Something!</h2>
                </div>
                <PostCard v-for="post in posts.data"
                    :post="post"
                    :subreddit="subreddit.slug"
                    :key="post.id"
                />

                <div class="mt-4 p-2" v-if="postCount > 0">
                    <Pagination :links="posts.meta.links" />
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:flex flex-col md:w-3/12 ml-3 hidden">
                <div class="shadow-md dark:text-white rounded-lg">
                    <h2 class="font-semibold text-large p-4 text-white rounded-t-lg dark:border-x-2 dark:border-t-2 dark:border-neutral-500"
                        :class="'text-' + colorInvert"
                        :style="'background-color:' + subreddit.color + ';'" >
                        About {{ subreddit.name }}
                    </h2>
                    <p class="p-4 bg-white dark:bg-neutral-700 dark:border-x-2 dark:border-neutral-500" >
                        {{ subreddit.description }}
                    </p>
                    <p class="p-4 bg-white rounded-b-lg dark:bg-neutral-700 dark:border-x-2 dark:border-b-2 dark:border-neutral-500">
                        <span class="font-bold">Subscribers:</span> {{ subreddit.subscribers }}
                    </p>
                </div>

                <div class="mt-6">
                    <SubredditList :subreddits="subreddits.data" :color="subreddit.color"/>
                </div>
            </div>
        </section>
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import SubredditList from "@/Components/SubredditList.vue";
import Subscribe from "@/Components/Subscribe.vue";
import { ref, computed, onMounted } from 'vue';

const element = ref(null);

// Calculate the relative luminance of the background color
const getLuminance = (rgb) => (0.2126 * rgb[0]) + (0.7152 * rgb[1]) + (0.0722 * rgb[2]);

// Get the background color of the element
const getBackgroundColor = () => {
    if (element.value) {
        return window.getComputedStyle(element.value).backgroundColor;
    }
    return null;
};

// Compute the text color class based on the background color
const colorInvert = computed(() => {
    const bgColor = getBackgroundColor();
    if (bgColor) {
        const rgb = bgColor.match(/\d+/g);
        const luminance = getLuminance(rgb);
        return luminance > 128 ? 'black' : 'white';
    }
    return null;
});

// Update the text color class when the component is mounted
onMounted(() => {
    colorInvert.value && element.value.classList.add(colorInvert.value);
});

defineProps({
    subreddit: Object,
    subreddits: Object,
    posts: Object,
    postCount: Object,
    ifUserSubscribed: Boolean,
    fileExt: String,
})
</script>
