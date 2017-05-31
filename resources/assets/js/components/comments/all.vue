<template>
    <div class="replies" v-if="replies.length > 0">
        <div class="reply" v-for="reply in replies">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="">{{ reply.user.name }}</a> replied {{ reply.created_at }}
                </div>
                <div class="panel-body">{{ reply.content }}</div>
                <ul class="list-group" v-if="reply.notes.length > 0">
                    <li class="list-group-item" v-for="note in reply.notes">
                        <a href="">{{ note.user.name }}</a>
                        {{ note.content }}
                    </li>
                </ul>
                <div class="panel-body" v-if="isReplying && data.comment === reply.id">
                    <form @submit.prevent="reply">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Post a reply..." v-model="data.note" required></textarea>
                        </div>
                        <button class="btn btn-warning" @click.prevent="cancelReply">cancel</button>
                        <button class="btn btn-primary" @click.prevent="postReply">reply</button>
                    </form>
                </div>
                <div class="panel-footer">
                    <a @click="setReplying(reply)"><i class="fa fa-reply"></i></a>
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
                replies: [],
                isReplying: false,
                data: {
                    comment: null,
                    note: null
                }
            };
        },

        methods: {
            setReplying(reply) {
                this.isReplying = true;
                this.data.comment = reply.id;
            },

            cancelReply() {
                this.isReplying = false;
                this.data.note = null;
            },

            postReply() {
                axios.post('/api/notes', this.data)
                    .then(response => {
                        this.refresh();
                        this.cancelReply();
                    });
            },

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
