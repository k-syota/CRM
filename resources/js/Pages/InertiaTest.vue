,<script setup>
import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
    Inertiaテスト<br>
    <a href="/">aタグでWelcomeに移動</a><br>
    <Link href="/">LinkでWelcomeに移動</Link><br>
    <Link :href="route('inertia.index')">名前付きルート</Link><br>
    <Link :href="route('inertia.show',{id:1})">ルートパラメーターつきルート</Link>
</template>
