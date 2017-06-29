<template>
    <div class="tickets all">
        <div class="row stick-to-top">
            <nav class="navbar navbar-default heading">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a data-toggle="dropdown">
                            department <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="">human resources</a></li>
                            <li><a href="">information technology</a></li>
                            <li><a href="">verizon</a></li>
                            <li><a href="">direct energy</a></li>
                            <li><a href="">allstate</a></li>
                        </ul>
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
