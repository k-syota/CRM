,<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import {ref} from 'vue'

const newTitle = ref("")
const newContent = ref("")
</script>

<template>
<div class="text-center">
    Inertiaテスト<br>
    <a href="/">aタグでWelcomeに移動</a><br>
    <Link href="/">LinkでWelcomeに移動</Link><br>
    <Link :href="route('inertia.index')">名前付きルート</Link><br>
    <Link :href="route('inertia.show',{id:1})">ルートパラメーターつきルート</Link><br>

    タイトル：<input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
    本文：<input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
    <Link as="button" method="post" :href="route('inertia.store')" :data="{title: newTitle,content: newContent}">保存テスト</Link>
</div>
</template>
