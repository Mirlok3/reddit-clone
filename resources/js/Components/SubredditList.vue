<template>
    <div class="w-full bg-white shadow-md border rounded-lg dark:bg-neutral-700 dark:border dark:border-neutral-500">
        <h2 class="font-semibold text-large p-4 bg-indigo-700 text-white rounded-t-lg"
            ref="element" :class="'text-' + colorInvert"
            :style="'background-color:' + color + ';'">
            {{ title || 'Top Subreddits' }}
        </h2>
        <ul role="list" class="divide-y divide-slate-300 truncate">
            <li class="py-3.5 sm:py-3.5 hover:bg-neutral-200 dark:hover:bg-neutral-600" v-for="subreddit in subreddits" :key="subreddit.id">
                <Link :href="route('frontend.subreddits.show', subreddit.slug)" class="flex items-center space-x-4 text-center p-2">
                    <div class="avatar w-1/3">
                        <img :src="subreddit.subreddit_image" class="w-10 h-10 rounded-full ring-2 ring-indigo-700 dark:ring-white p-0.5">
                    </div>

                    <div class="text-slate-800 font-semibold text-xl dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-300 truncate w-2/3 text-left">
                        {{ subreddit.name }}
                    </div>

                    <div class="text-xs dark:text-gray-300 flex-col border-l pl-1.5 text-left w-1/3">
                        <p>{{ subreddit.subscribers_count }} <span v-if="subreddit.subscribers_count == 1">subscriber</span> <span v-else>subscribers</span> </p>
                        <p>{{ subreddit.posts_count }} <span v-if="subreddit.posts_count == 1">post</span> <span v-else>posts</span> </p>
                    </div>
                </Link>
            </li>
        </ul>

    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import {computed, onMounted, ref} from "vue";

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
    subreddits: Object,
    color: String,
    title: String,
})
</script>
