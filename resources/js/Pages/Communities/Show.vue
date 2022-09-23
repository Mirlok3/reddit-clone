<template>
    <h1>r/{{ subreddit.name }}</h1>
</template>

<script setup>
defineProps({
    subreddit: Object(),
})
</script>
