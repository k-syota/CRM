,<script setup>
import {Link} from '@inertiajs/inertia-vue3'
defineProps({
    id: String
})
</script>

<template>
    show<br>
    <p>{{ id }}</p>
    <a href="/">aタグでWelcomeに移動</a><br>
    <Link href="/">LinkでWelcomeに移動</Link>
</template>
