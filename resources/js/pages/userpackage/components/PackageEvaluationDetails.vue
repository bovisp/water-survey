<template>
    <div class="w-full mt-8">
        <div class="flex items-center">
            <h2 class="text-2xl">
                Evaluation details
            </h2>

            <button
                class="btn btn-text text-sm ml-2"
                v-if="!editing && !isComplete && hasRole(['manager', 'head_of_operations', 'supervisor'])"
                @click.prevent="editing = true"
            >
                Edit
            </button>
        </div>

        <p
            class="mt-2 text-sm"
            v-if="userPackage.evaluated_by"
        >
            <strong>Evaluated by:</strong>
            {{ userPackage.evaluated_by.firstname }} {{ userPackage.evaluated_by.lastname }}
            ({{ ucfirst(userPackage.evaluated_by.role) }}) on {{ fromMySQLDateFormat(userPackage.evaluated_at) }}
        </p>

        <div class="mt-2" v-if="editing">
            <vue-editor
                v-model="evaluation_details"
                :editorToolbar="customToolbar"
            ></vue-editor>

            <div
                class="w-full mt-4"
            >
                <button
                    class="btn btn-blue text-sm"
                    @click.prevent="$emit('save')"
                >
                    Save
                </button>

                <button
                    class="btn btn-text text-sm"
                    @click.prevent="cancel"
                >
                    Cancel
                </button>
            </div>
        </div>

        <article
            v-if="!editing"
            v-html="formattedEvaluationDetails"
            class="content mt-2"
        ></article>

        <div
            v-if="!editing && formattedEvaluationDetails === ''"
            class="alert alert-blue mt-2"
        >No evaluation details entered yet.</div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import { VueEditor, Quill } from 'vue2-editor'
import isComplete from '../../../mixins/isComplete'
import fromMySQLDateFormat from '../../../helpers/fromMySQLDateFormat'
import ucfirst from '../../../helpers/ucfirst'

export default {
    mixins: [ isComplete ],

    components: {
        VueEditor
    },

    data() {
        return {
            editing: false,
            counter: 0,
            evaluation_details: '',
            customToolbar: [
                [{header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline"],
                [{script: 'sub'}, {script: 'super'}],
                [{align: []}],
                [{ list: "ordered" }, { list: "bullet" }],
                [{indent: '-1'}, {indent: '+1'}],
                ["link", "image"]
            ]
        }
    },

    computed: {
        ...mapGetters({
            userPackage: 'userpackage/userPackage'
        }),
        formattedEvaluationDetails () {
            return this.evaluation_details
                .replace(/<p><br><\/p>/g, '')
                .replace(/<p class="ql-align-justify"><br><\/p>/g, '')
                .replace(/<p class="ql-align-right"><br><\/p>/g, '')
                .replace(/<p class="ql-align-left"><br><\/p>/g, '')
        }
    },

    watch: {
        userPackage: {
            deep: true,

            handler () {
                this.evaluation_details = this.userPackage.evaluation_details ? this.userPackage.evaluation_details : ''
            }
        },

        evaluation_details () {
            // console.log('here')
            // if (this.counter !== 0) {
                this.$emit('userpackage:change', [
                    {
                        type: 'evaluation_details',
                        value: this.evaluation_details
                    }
                ])
            // }

            // this.counter += 1
        }
    },

    methods: {
        ...mapActions({
            fetch: 'userpackage/fetch'
        }),

        fromMySQLDateFormat,

        ucfirst,

        cancel () {
            this.editing = false

            this.fetch({
                userId: this.userPackage.user_id,
                userpackageId: this.userPackage.id
            })
        }
    },

    mounted () {
        window.events.$on('userpackage:updated', message => {
            this.editing = false
        })
    }
}
</script>
