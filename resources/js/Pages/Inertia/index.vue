<script setup>
import {Link} from '@inertiajs/inertia-vue3'

defineProps({
    blogs: Array
})
</script>

<template>
    <div class="text-center">
        Index<br>
        <div class="my-4 bg-blue-300" v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </div>
        <a href="/">aタグでWelcomeに移動</a><br>
        <Link href="/">LinkでWelcomeに移動</Link>

        <ul>
            <li v-for="blog in blogs" :key="blog.id">
            件名：
            <Link class="text-blue-400" :href="route('inertia.show',{id: blog.id})">
                {{ blog.title }}
            </Link>,
            本文：{{ blog.content }}
            </li>
        </ul>
    </div>
</template>
