<template>
    <div class="w-full">
        <h1 class="text-3xl font-bold mb-4">
            New lesson
        </h1>

        <form 
            @submit.prevent="store"
        >
            <div
                class="w-full mb-4"
            >
                <label 
                    for="lesson_version_id"
                    class="block text-gray-700 font-bold mb-2"
                >
                    Lesson version
                </label>

                <div class="relative">
                    <select 
                        id="lesson_version_id"
                        v-model="form.lesson_version_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': errors.lesson_version_id }"
                    >
                        <option value=""></option>

                        <option
                            :value="lessonVersion.id"
                            v-for="lessonVersion in lessonVersions"
                            :key="lessonVersion.id"
                            v-text="lessonVersion.version"
                        ></option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <p
                    v-if="errors.lesson_version_id"
                    v-text="errors.lesson_version_id[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full mb-4"
            >
                <label 
                    for="topic_id"
                    class="block text-gray-700 font-bold mb-2"
                >
                    Topic
                </label>

                <div class="relative">
                    <select 
                        id="topic_id"
                        v-model="form.topic_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': errors.topic_id }"
                    >
                        <option value=""></option>

                        <option
                            :value="topic.id"
                            v-for="topic in topics"
                            :key="topic.id"
                            v-text="`${topic.number} - ${topic.name}`"
                        ></option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <p
                    v-if="errors.topic_id"
                    v-text="errors.topic_id[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full mb-4"
            >
                <label 
                    for="level_id"
                    class="block text-gray-700 font-bold mb-2"
                >
                    Level
                </label>

                <div class="relative">
                    <select 
                        id="level_id"
                        v-model="form.level_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': errors.level_id }"
                    >
                        <option value=""></option>

                        <option
                            :value="level.id"
                            v-for="level in levels"
                            :key="level.id"
                            v-text="level.name"
                        ></option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <p
                    v-if="errors.level_id"
                    v-text="errors.level_id[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full mb-4"
            >
                <label 
                    class="block text-gray-700 font-bold mb-2" 
                    :class="{ 'text-red-500': errors.number }"
                    for="number"
                >
                    Number
                </label>

                <input 
                    type="text" 
                    v-model="form.number"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-auto"
                    :class="{ 'border-red-500': errors.number }"
                    id="number"
                >

                <p
                    v-if="errors.number"
                    v-text="errors.number[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full mb-4"
            >
                <label 
                    class="block text-gray-700 font-bold mb-2" 
                    :class="{ 'text-red-500': errors.name_en }"
                    for="name_en"
                >
                    Name (English)
                </label>

                <input 
                    type="text" 
                    v-model="form.name_en"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-auto"
                    id="name_en"
                    :class="{ 'border-red-500': errors.name_en }"
                >

                <p
                    v-if="errors.name_en"
                    v-text="errors.name_en[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full mb-4"
            >
                <label 
                    class="block text-gray-700 font-bold mb-2" 
                    :class="{ 'text-red-500': errors.name_fr }"
                    for="name_fr"
                >
                    Name (French)
                </label>

                <input 
                    type="text" 
                    v-model="form.name_fr"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-auto"
                    id="name_fr"
                    :class="{ 'border-red-500': errors.name_fr }"
                >

                <p
                    v-if="errors.name_fr"
                    v-text="errors.name_fr[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full mb-4"
            >
                <label 
                    class="block text-gray-700" 
                    :class="{ 'text-red-500': errors.completed_in_both }"
                    for="completed_in_both"
                >
                    <input 
                        type="checkbox" 
                        v-model="form.completed_in_both"
                        id="completed_in_both"
                        :class="{ 'border-red-500': errors.completed_in_both }"
                    >
                    This lesson can be intiated either at the EG-03 or EG-04 Level.
                </label>

                <p
                    v-if="errors.completed_in_both"
                    v-text="errors.completed_in_both[0]"
                    class="text-red-500 text-sm"
                ></p>
            </div>

            <div
                class="w-full"
            >
                <button 
                    class="btn btn-blue text-sm"
                >
                    Create lesson
                </button>

                <button 
                    class="btn btn-text text-sm"
                    @click.prevent="cancel"
                >
                    Cancel
                </button>
            </div>
        </form>

        <modal 
            v-show="modalActive"
            @close="modalActive = false"
            @submit="close"
        >
            <template slot="header">
                No version specified
            </template>

            <template slot="body">
                <div class="my-4">
                    No lesson version has been specified. If you do not specify 
                    a lesson version, this new lesson will be applied to all versions.
                </div>
            </template>
        </modal>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            form: {
                name_en: '',
                name_fr: '',
                number: null,
                level_id: null,
                lesson_version: null,
                completed_in_both: false,
                topic_id: null
            },
            modalActive: false,
            confirmed: false
        }
    },

    computed: {
        ...mapGetters({
            levels: 'levels/levels',
            lessonVersions: 'lessonVersions/lessonVersions',
            topics: 'topics/topics'
        })
    },

    methods: {
        ...mapActions({
            fetchLevels: 'levels/fetch',
            fetchTopics: 'topics/fetch',
            fetchLessonVersions: 'lessonVersions/fetch'
        }),

        close () {
            this.modalActive = false
            this.confirmed = true
            delete this.form.lesson_version_id

            this.store()
        },

        cancel () {
            window.events.$emit('lessons:create-cancel')

            this.form.name_en = ''
            this.form.name_fr = ''
            this.form.number = null
            this.form.level_id = null
            this.form.lesson_version = null
            this.form.completed_in_both = false
            this.form.topic_id = null
        },

        async store () {
            if (!this.form.lesson_version_id && !this.confirmed) {
                this.modalActive = true

                return
            }

            let { data } = await axios.post(`${this.urlBase}/api/lessons`, this.form)

            this.cancel()

            this.$toasted.success(data.data.message)
        },
    },

    async mounted () {
        await this.fetchTopics()

        await this.fetchLevels()

        await this.fetchLessonVersions()
    }
}
</script>