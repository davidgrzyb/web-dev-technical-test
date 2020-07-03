<template>
    <main class="grid grid-cols-1 md:grid-cols-3 gap-4 md:px-2 pt-4">
        <Photo
            v-for="photo in album" :key="photo.id"
            :photo=photo />
    </main>
</template>

<script>
import Photo from './Photo.vue'

export default {
    name: 'Album',
    components: {
        Photo
    },
    props: {
        album: Array
    }
}
</script>