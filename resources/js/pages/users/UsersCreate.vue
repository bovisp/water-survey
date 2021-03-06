<template>
    <div class="w-full lg:w-9/12">   
        <h1 class="text-3xl font-bold mb-4">
            Add users
        </h1> 

        <div class="flex justify-center w-full mb-6 pb-6 border-b border-gray-200">
            <div>
                <label 
                    for="roles"
                    class="block text-gray-700 font-bold mb-2"
                >
                    Register users as...
                </label>
                <div class="relative">
                    <select 
                        id="roles"
                        v-model="role"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value=""></option>

                        <option
                            :value="r.name"
                            v-for="r in roles"
                            :key="r.id"
                            v-text="ucfirst(r.name)"
                        ></option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <datatable 
            :data="users"
            :columns="columns"
            :per-page="10"
            :order-keys="['lastname', 'firstname']"
            :order-key-directions="['asc', 'asc']"
            :has-text-filter="true"
            :checkable="true"
        >
            <button
                @click.prevent="cancel"
                class="btn btn-text text-red-500 mr-2"
            >Cancel</button>

            <button 
                @click.prevent="store"
                class="btn btn-blue"
            >Create account{{ selected.length > 1 ? 's' : '' }}</button>
        </datatable>
    </div>
</template>

<script>
import { map, forEach, reject, isEmpty } from 'lodash-es'
import ucfirst from '../../helpers/ucfirst'

export default {
    data() {
        return {
            users: [],
            columns: [
                { field: 'firstname', title: 'First name', sortable: true },
                { field: 'lastname', title: 'Last name', sortable: true },
                { field: 'email', title: 'Email', sortable: false }
            ],
            selected: [],
            roles: [],
            role: ''
        }
    },

    methods: {
        ucfirst, 
        
        async store () {
            let { data } = await axios.post(`${this.urlBase}/api/users/moodle`, {
                role: this.role,
                users: this.selected
            })

            this.reset()

            window.events.$emit('datatable:clear')

            this.$toasted.success(data.data.message)
        },

        reset () {
            this.selected = []
            this.roles = []
            this.role = ''
        },

        cancel () {
            this.reset()

            window.events.$emit('datatable:cancel')
        }
    },

    async mounted () {
        let { data: users } = await axios.get(`${this.urlBase}/api/users/moodle/create`)
        let { data: roles } = await axios.get(`${this.urlBase}/api/roles`)

        this.users = users
        this.roles = roles

        window.events.$on('users:selected', users => {
            this.selected = users
        })
    }
}
</script>