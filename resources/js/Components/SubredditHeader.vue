<template>
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
                    <span class="hidden lg:block mx-auto text-black">Create a post</span>

                </Link>
                <Subscribe :subreddit="subreddit" :ifUserSubscribed="ifUserSubscribed"
                           class="text-black md:px-3 md:py-2 rounded-full bg-white hover:bg-gray-200 text-black md:mr-6 font-semibold md:pr-4 p-1 pt-1.5 mr-1 flex justify-between border-4"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Subscribe from "@/Components/Subscribe.vue";
import { ref, computed, onMounted } from 'vue';

defineProps({
    subreddit: Object,
    ifUserSubscribed: Number,
});

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

</script>
