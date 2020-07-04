<template>
    <header class="flex flex-col md:flex-row items-center bg-white rounded shadow px-10 py-6">
        <!-- Profile Image -->
        <div class="w-full md:w-1/6 flex justify-center">
            <img :src="require('../assets/' + picture)" :alt="name" class="w-32 h-32 rounded-full">
        </div>

        <!-- Name, Bio & Contact Info Sections -->
        <div class="w-full md:w-5/6 md:pl-5 text-center md:text-left">
            <div class="mt-2 md:mt-0">
                <a href="#" class="hover:underline focus:outline-none focus:underline">
                    <h1 class="text-2xl font-semibold">{{ name }}</h1>
                </a>
            </div>
            <div class="flex flex-col md:flex-row">
                <!-- Bio Section -->
                <div class="mt-3 md:mt-1">
                    <h4 class="text-xs font-semibold text-gray-500">Bio</h4>
                    <p class="text-xs text-gray-500">{{ bio }}</p>
                </div>
                <!-- Contact Info Section -->
                <div class="leading-tight md:pr-10 mt-4 md:mt-0">
                    <h4 class="text-xs font-semibold text-gray-500">Phone</h4>
                    <a :href="'tel:' + phone" class="text-xs text-pink-600 hover:underline focus:outline-none focus:underline">{{ phone }}</a>
                    <h4 class="text-xs font-semibold text-gray-500 mt-1">Email</h4>
                    <a :href="'mailto:' + email" class="text-xs text-pink-600 hover:underline focus:outline-none focus:underline">{{ email }}</a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Header',
    props: {
        name: String,
        bio: String,
        phone: String,
        email: String,
        picture: String
    }
}
</script>