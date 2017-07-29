<template>
    <div class="dropdown">
        <a class="tag" :style="{ 'background-color': ticket.type.color }" data-toggle="dropdown">
            {{ ticket.type.type }}
        </a>
        <ul class="dropdown-menu custom-menu">
            <li class="header">Ticket Type</li>
            <li v-for="type in types" :class="{ disabled : type.id === ticket.type.id }">
                <a @click="update(type)">
                    <i class="fa fa-square" :style="{ color: type.color }" style="margin-right: 5px"></i>
                    {{ type.type }}
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
            axios.get('/api/types')
                .then(response => {
                    this.types = response.data;
                });
        },

        data() {
            return {
                types: []
            };
        },

        methods: {
            update(type) {
                let ticket = this.ticket.id;
                this.ticket.type = type;
                
                axios.put(`/api/tickets/${ticket}/type`, { type: type.id })
                    .then(response => {
                        sweetAlert('Success', 'The type of this ticket has been updated.', 'success');
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the type of this ticket.', 'error');
                    });
            }
        }
    }
</script>
