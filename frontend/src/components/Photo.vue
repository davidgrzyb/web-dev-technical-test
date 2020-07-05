<template>
    <section class="bg-white rounded">
        <div href="#" class="relative">
            <img :src="require('../assets/' + photo.img)" :alt="photo.title" class="rounded-t">
            <a href="#" class="absolute bottom-0 left-0 text-lg font-bold text-white pb-1 pl-2 hover:underline focus:outline-none focus:underline">{{ photo.title }}</a>
        </div>
        <div class="flex flex-col px-6 pt-1 pb-4">
            <p class="text-xxs text-gray-600 text-justify">{{ photo.description }}</p>
            <div :class="photo.featured ? 'justify-between' : 'justify-end'" class="flex items-center pt-1">
                <span v-if="photo.featured">❤️</span>
                <span class="text-xxs text-gray-500">{{ photo.date }}</span>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Photo',
    props: {
        photo: Object
    }
}
</script>