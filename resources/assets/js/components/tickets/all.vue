<template>
    <div class="tickets all">
        <div class="row stick-to-top">
            <nav class="navbar navbar-default heading">
                <ul class="pager navbar-right">
                    <li><a href="">last</a></li>
                    <li><a href="">next</a></li>
                </ul>
            </nav>
        </div>
        <div class="ticket" v-for="ticket in tickets">
            <div class="pull-left">
                <h3>
                    <span class="status">
                        <i class="fa fa-warning"></i>
                    </span>
                    <span class="department">{{ ticket.department.department }}</span>
                    <a :href="'/tickets/' + ticket.id">{{ ticket.title }}</a>
                </h3>
                <h4>#{{ ticket.id }} opened on May 2nd by {{ ticket.user.name }}</h4>
            </div>
            <div class="meta pull-right">
                <div class="comments">
                    <span>
                        <i class="fa fa-comments-o"></i>
                        {{ ticket.comments.length }}
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.refresh();
            this.refreshTypes();
            this.refreshStatuses();
            this.refreshPriorities();
            this.refreshDepartments();
        },

        data() {
            return {
                tickets: [],
                departments: [],
                types: [],
                statuses: [],
                priorities: [],
                filters: {
                    department: [],
                    type: [],
                    status: [],
                    priority: []
                }
            };
        },

        methods: {
            refresh() {
                axios.get('/api/tickets')
                    .then(response => {
                        this.tickets = response.data;
                    });
            },

            refreshWithFilters() {
                axios.post('/api/tickets/search', { filters: this.filters })
                    .then(response => {
                        this.tickets = response.data;
                    });
            },

            refreshTypes() {
                axios.get('/api/types')
                    .then(response => {
                        this.types = response.data;
                    });
            },

            refreshStatuses() {
                axios.get('/api/status')
                    .then(response => {
                        this.statuses = response.data;
                    });
            },

            refreshPriorities() {
                axios.get('/api/priorities')
                    .then(response => {
                        this.priorities = response.data;
                    });
            },

            refreshDepartments() {
                axios.get('/api/departments')
                    .then(response => {
                        this.departments = response.data;
                    });
            }
        }
    }
</script>
