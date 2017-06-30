<template>
    <div class="replies no-margin-top" v-if="replies.length > 0">
        <div class="row" v-for="reply in replies">
            <div class="reply">
                <div class="col-sm-1">
                    <div class="image">
                        <img src="http://www.mtlwalks.com/images/empty_profile.jpg">
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ reply.user.name }} replied 6 days ago</div>
                        <div class="panel-body">
                            {{ reply.content }}
                        </div>
                    </div>
                    <ul v-if="reply.notes.length > 0" class="notes">
                        <li v-for="note in reply.notes" class="note">
                            <i class="fa fa-comment-o"></i>
                            <span class="heading">
                                <a class="user">{{ note.user.name }}</a>
                            </span>
                            <span class="content">{{ note.content }}</span>
                        </li>
                    </ul>
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
                replies: [],
                data: {
                    comment: null,
                    note: null
                }
            };
        },

        methods: {
            refresh() {
                let ticket = this.ticket;

                axios.get(`/api/comments/${ticket}`)
                    .then(response => {
                        this.replies = response.data;
                        console.log(this.replies);
                    });
            }
        }
    }
</script>
