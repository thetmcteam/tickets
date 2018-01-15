<template>
   <div class="dropdown">
       <a class="tag" :style="{ 'background-color': ticket.priority.color }" data-toggle="dropdown">
            {{ ticket.priority.priority }}
        </a>
        <ul class="dropdown-menu custom-menu" v-if="isAdmin()">
            <li class="header">Ticket Priority</li>
            <li v-for="priority in priorities" v-if="priority.id !== ticket.priority.id">
                <a @click="update(priority)">
                    <i class="fa fa-square" :style="{ color: priority.color }" style="margin-right: 5px"></i>
                    {{ priority.priority }}
                </a>
            </li>
        </ul>
   </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket'],

        created() {
            axios.get('/api/priorities')
                .then(response => {
                    this.priorities = response.data;
                });
        },

        data() {
            return {
                priorities: []
            };
        },

        methods: {
            isAdmin() {
                return Boolean(window.user.admin);
            },

            update(priority) {
                let ticket = this.ticket.id;
                this.ticket.priority = priority;

                axios.put(`/api/tickets/${ticket}/priority`, { priority: priority.id })
                    .then(response => {
                        sweetAlert('Success', 'The priority of this ticket has been updated.', 'success');
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the priority of this ticket.', 'error');
                    });
            }
        }
    }
</script>
