<template>
    <div class="flex flex-col items-center w-full lg:w-9/12 py-16 mx-auto">
        <nav 
            class="flex justify-end w-full items-center"
            v-if="!creating && !updating"
        >
            <a 
                href=""
                @click.prevent="creating = true"
                class="btn btn-text"
            >Add logbook category</a>
        </nav>

        <logbook-categories-create 
            v-if="creating"
        />

        <logbook-categories-edit 
            v-if="updating"
        />

        <logbook-categories-index 
            v-if="!creating && !updating"
        />
    </div>
</template>

<script>
export default {
     data() {
        return {
            creating: false,
            updating: false
        }
    },

    mounted () {
        window.events.$on('logbook-categories:edit', () => {
            this.updating = true
        })

        window.events.$on('logbook-categories:edit-cancel', () => {
            this.updating = false
        })

        window.events.$on('logbook-categories:create-cancel', () => {
            this.creating = false
        })
    }
}
</script>