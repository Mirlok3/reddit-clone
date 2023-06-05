<template>
    <div class="mb-4 ml-3 hidden flex-col md:flex md:w-3/12">
        <Link class="mb-4 rounded-lg border bg-indigo-700 p-4 font-semibold text-white text-large dark:border-x dark:border-t dark:border-neutral-500
                     hover:bg-opacity-75"
              v-if="auth" :class="'text-' + colorInvert"
              :style="'background-color:' + subreddit.color + ';'"
              :href="route('subreddit.users', subreddit)">Admin panel
        </Link>
        <div class="rounded-lg shadow-md dark:text-white">
            <h2 class="rounded-t-lg border-b bg-indigo-700 p-4 font-semibold text-white text-large dark:border-x dark:border-t dark:border-neutral-500"
                ref="element" :class="'text-' + colorInvert" :style="'background-color:' + subreddit.color + ';'" >
                About {{ subreddit.name }}
            </h2>
            <p class="bg-white p-4 dark:bg-neutral-700 dark:border-x dark:border-neutral-500" >
                {{ subreddit.description }}
            </p>

            <div class="flex items-center justify-between rounded-b-lg bg-white p-4 px-12 dark:bg-neutral-700 dark:border-x dark:border-b dark:border-neutral-500">
                <div>
                    <div class="font-semibold">Subscribers</div>
                    <div class="text-center font-extralight">{{ subreddit.subscribers }}</div>
                </div>
                <div>
                    <div class="font-semibold">Posts</div>
                    <div class="text-center font-extralight">{{ subreddit.posts_count }}</div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <SubredditList :subreddits="subreddits.data" :color="subreddit.color" title="Top Subreddits"/>
        </div>
    </div>
</template>

<script setup>
    import SubredditList from "@/Components/SubredditList.vue";
    import { ref, computed, onMounted } from 'vue';
    import {Link} from "@inertiajs/inertia-vue3"

    defineProps({
        subreddit: Object,
        subreddits: Object,
        postCount: Number,
        auth: Boolean,
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
