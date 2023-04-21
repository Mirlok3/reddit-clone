<template>
    <div class="md:flex flex-col md:w-3/12 ml-3 hidden mb-4">
        <div class="shadow-md dark:text-white rounded-lg">
            <h2 class="border-b font-semibold text-large p-4 text-white bg-indigo-700 rounded-t-lg dark:border-x dark:border-t dark:border-neutral-500"
                ref="element" :class="'text-' + colorInvert"
                :style="'background-color:' + subreddit.color + ';'" >
                About {{ subreddit.name }}
            </h2>
            <p class="p-4 bg-white dark:bg-neutral-700 dark:border-x dark:border-neutral-500" >
                {{ subreddit.description }}
            </p>

            <div class="flex items-center justify-between px-12 p-4 bg-white rounded-b-lg dark:bg-neutral-700 dark:border-x dark:border-b dark:border-neutral-500">
                <div>
                    <div class="font-semibold">Subscribers</div>
                    <div class="font-extralight text-center">{{ subreddit.subscribers }}</div>
                </div>
                <div>
                    <div class="font-semibold">Posts</div>
                    <div class="font-extralight text-center">{{ subreddit.posts_count }}</div>
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

    defineProps({
        subreddit: Object,
        subreddits: Object,
        postCount: Number,
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
