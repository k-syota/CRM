<script setup>
import {reactive} from 'vue'
import { Inertia } from '@inertiajs/inertia'

defineProps({
    errors: Object
})

const form = reactive({
    title:null,
    content: null
})

const submitFunction = () => {
    Inertia.post('/inertia',form)
}
</script>

<template>
    <div class="text-center mt-10">
        <form @submit.prevent="submitFunction">
            タイトル：<input type="text" name="title" v-model="form.title"><br>
            <div v-if="errors.title">{{ errors.title }}</div>
            本文：<input class="mt-4" type="text" name="title" v-model="form.content"><br>
            <div v-if="errors.content">{{ errors.content }}</div>
            <button>送信</button>
        </form>
    </div>

</template>
