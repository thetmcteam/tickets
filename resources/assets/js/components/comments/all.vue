<template>
    <div class="replies" v-if="replies.length > 0">
        <div class="reply" v-for="reply in replies">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="">{{ reply.user.name }}</a> replied
                    <!-- {{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment['created_at']))->diffForHumans() }} -->
                </div>
                <div class="panel-body">{{ reply.content }}</div>
                <ul class="list-group" v-if="reply.notes.length > 0">
                    <li class="list-group-item" v-for="note in reply.notes">
                        <a href="">{{ note.user.name }}</a>
                        {{ note.content }}
                        <!-- <i>({{ \Carbon\Carbon::createFromTimeStamp(strtotime($note['created_at']))->diffForHumans() }})</i> -->
                    </li>
                </ul>
                <div class="panel-footer">
                    <a><i class="fa fa-reply"></i></a>
                    <a><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ticket'],

        created() {
            Bus.$on('comments:refresh', () => {
                this.refresh();

                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 1000);
            });
            this.refresh();
        },

        data() {
            return {
                replies: []
            };
        },

        methods: {
            refresh() {
                let ticket = this.ticket;
                
                axios.get(`/api/comments/${ticket}`)
                    .then(response => {
                        this.replies = response.data;
                    });
            }
        }
    }
</script>
