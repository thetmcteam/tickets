<template>
    <div class="tickets all">
        <div class="row">
            <nav class="navbar navbar-default heading stick-to-top">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="">
                            department <span class="caret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            status  <span class="caret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            priority  <span class="caret"></span>
                        </a>
                    </li>
                </ul>
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
            <div class="comments pull-right">
                <i class="fa fa-comments-o"></i>
                {{ ticket.comments.length }}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.refresh();
        },

        data() {
            return {
                tickets: []
            };
        },

        methods: {
            refresh() {
                axios.get('/api/tickets')
                    .then(response => {
                        this.tickets = response.data;
                    });
            }
        }
    }
</script>
