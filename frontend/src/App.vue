<template>
	<div id="app" class="container w-full md:max-w-4xl mx-auto">
		<p v-if="loading && !error" class="text-2xl font-semibold text-white text-center">Loading...</p>
		<p v-if="error" class="text-2xl font-semibold text-red-500 text-center">{{ error }}</p>
		<Header
			v-if="!loading && !error"
			:name="name"
			:bio="bio"
			:phone="phone"
			:email="email"
			:picture="picture" />
		<Album v-if="!loading && !error" :album="album" />
	</div>
</template>

<script>
import axios from 'axios'
import Album from './components/Album.vue'
import Header from './components/Header.vue'

import './assets/css/main.css'

export default {
	name: 'App',
	data() {
		return {
			loading: true,
			error: null,
			name: null,
			bio: null,
			phone: null,
			email: null,
			picture: null,
			album: null
		}
	},
	methods: {
		async getData() {
			try {
				const { data } = await axios.get('/json/landscapes.json')

				this.name = data.name
				this.bio = data.bio
				this.phone = data.phone
				this.email = data.email
				this.picture = data.profile_picture
				this.album = data.album

				this.loading = false
			} catch (error) {
				if (error.response.status === 404) {
					this.error = 'Error: File not found.'
				} else {
					this.error = 'Oops! An error has occurred.'
				}
			}
		}
	},
	created() {
		this.getData()
	},
	components: {
		Album,
		Header
	}
}
</script>