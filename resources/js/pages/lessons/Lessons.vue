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
            >Add lesson</a>
        </nav>

        <lessons-create 
            v-if="creating"
        />

        <lessons-edit 
            v-if="updating"
        />

        <lessons-index 
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
        window.events.$on('lessons:edit', () => {
            this.updating = true
        })

        window.events.$on('lessons:edit-cancel', lesson => {
            this.updating = false
        })

        window.events.$on('lessons:create-cancel', () => {
            this.creating = false
        })
    }
}
</script>