<template>
    <div class="relative">
        <button
            class="btn relative z-20"
            @click.prevent="isOpen = !isOpen"
        >Menu&nbsp;&dtrif;</button>

        <button 
            class="fixed inset-0 h-full w-full transparent cursor-default z-10"
            v-if="isOpen"
            @click.prevent="isOpen = false"
            tabindex="-1"
        ></button>

        <div 
            class="absolute z-20 right-0 bg-white flex flex-col rounded shadow-md border border-gray-200 py-3 w-64"
            style="top: 50px;"
            v-if="isOpen"
        >
            <span class="pb-2 px-3">Logged in as: <a :href="`${urlBase}/users/${authUser.id}`"><strong>{{ authUser.name }}</strong></a></span>  

            <hr class="border-t border-gray-300">

            <a class="text-gray-900 py-2 px-3" :href="`${urlBase}/logbooks`">Manage Log Book Entries</a>

            <template v-if="hasRole(['apprentice']) && authUser.role !== 'administrator'">
                <strong class="text-gray-900 pt-2 pb-0 px-3">Reports</strong>

                <a 
                    class="text-gray-900 py-1 pl-5 pr-3 text-sm" 
                    :href="`${urlBase}/reports/sot/${authUser.id}`"
                >View schedule of training</a>
            </template>

            <template v-if="hasRole(['administrator'])">
                <a class="text-gray-900 py-2 px-3" :href="`${urlBase}/users`">Manage users</a>

                <strong class="text-gray-900 pt-2 pb-0 px-3">Manage lesson packages</strong>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/levels`">Working levels</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/lesson-versions`">Lesson package versions</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/lessons`">Lesson package information</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/objectives`">Edit lesson objectives</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/topics`">Lesson package topics</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/logbook-categories`">Logbook categories</a>

                <strong class="text-gray-900 pt-2 pb-0 px-3">Reports</strong>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/recommendations`">Manage supervisor recommendations</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/statuses`">Manage lesson package statuses</a>

                <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/reports/users/download`">Generate appointment date report</a>
            </template>

            <strong class="text-gray-900 pt-2 pb-0 px-3">Issues</strong>

            <a class="text-gray-900 py-1 pl-5 pr-3 text-sm" :href="`${urlBase}/issues`">Report an issue</a>

            <template v-if="hasRole(['supervisor', 'head_of_operations'])">
                <strong class="text-gray-900 pt-2 pb-0 px-3">Reports</strong>
                
                <a 
                    class="text-gray-900 pt-1 pb-2 pl-5 pr-3 text-sm" 
                    :href="`${urlBase}/reports/rot`"
                >View SoTs and RoTs</a>
            </template>

            <hr class="border-t border-gray-300">

            <a 
                href="#"
                class="text-gray-900 pt-2 px-3"
                @click.prevent="logout"
            >Logout</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false
        }
    },

    methods: {
        async logout () {
            await axios.post(`${this.urlBase}/logout`)

            window.location.href = this.urlBase
        }
    },

    created() {
        const handleEscape = e => {
            if (e.key === 'Esc' || e.key === 'Escape') {
                this.isOpen = false
            }
        }

        document.addEventListener('keydown', handleEscape)

        this.$once('hook:beforeDestroy', () => {
            document.removeEventListener('keydown', handleEscape)
        })
    },
}
</script>