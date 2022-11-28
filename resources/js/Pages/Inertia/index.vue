,<script setup>
import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
    <div class="text-center">
        Index<br>
        <div class="my-4 bg-blue-300" v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </div>
        <a href="/">aタグでWelcomeに移動</a><br>
        <Link href="/">LinkでWelcomeに移動</Link>
    </div>
</template>
