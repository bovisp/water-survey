<template>
    <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center">
        <overlay 
            @close="close"
        />

        <div 
            class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto p-5"
        >
            <h1
                v-if="this.$slots.header"
                class="text-2xl"
            >
                <slot name="header"></slot>
            </h1>

            <div
                v-if="this.$slots.body"
            >
                <slot name="body"></slot>
            </div>

            <div class="flex w-full">
                <div 
                    class="w-1/2 pr-2 ml-auto"
                    v-if="hasCancelButton"
                >
                    <button 
                        class="btn btn-outline w-full"
                        @click.prevent="close"
                    >
                        {{ cancelButtonText }}
                    </button>
                </div>

                <div 
                    class="w-1/2 pl-2 ml-auto"
                    v-if="hasOkButton"
                >
                    <button 
                        class="btn btn-blue w-full"
                        @click.prevent="$emit('submit')"
                    >
                        {{ okButtonText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        hasOkButton: {
            type: Boolean,
            required: false,
            default: true
        },

        okButtonText: {
            type: String,
            required: false,
            default: 'Submit'
        },

        hasCancelButton: {
            type: Boolean,
            required: false,
            default: true
        },

        cancelButtonText: {
            type: String,
            required: false,
            default: 'Cancel'
        }
    },

    methods: {
        close (e) {
            this.$emit('close')
        }
    }
}
</script>