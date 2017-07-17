<template>
    <div class="replies" v-if="replies.length > 0">
        <div class="row" v-for="reply in replies">
            <div class="reply">
                <div class="col-sm-1">
                    <div class="image">
                        <img :src="reply.user.image ? reply.user.image : '/images/profile.jpg'">
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ reply.user.name }} replied <timeago :since="reply.created_at"></timeago>
                        </div>
                        <div class="panel-body">
                            {{ reply.content }}
                        </div>
                        <div class="panel-footer">
                            <ul class="list-inline no-margin">
                                <li><a @click="showReplyFor(reply.id)"><i class="fa fa-reply"></i></a></li>
                                <li><a @click="destroy(reply.id)"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </div>
                        <div class="panel-body has-border-top" v-if="data.comment === reply.id">
                            <form @submit.prevent="saveReply">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Say Something..." v-model="data.note"></textarea>
                                </div>
                                <button class="btn btn-danger" @click="data.comment = null">Cancel</button>
                                <button class="btn btn-primary pull-right">Reply</button>
                            </form>
                        </div>
                    </div>
                    <ul v-if="reply.notes.length > 0" class="notes">
                        <li v-for="note in reply.notes" class="note">
                            <!-- <i class="fa fa-comment-o"></i> -->
                            <a data-toggle="tooltip" data-placement="left" title="test">
                                <img src="/images/speech-bubble.png" class="timebar-icon">
                            </a>
                            <span class="heading">
                                <img :src="reply.user.image ? reply.user.image : '/images/profile.jpg'">
                                <a class="user">{{ note.user.name }}</a>
                                <span style="color: #586069">
                                    said <timeago :since="note.created_at"></timeago>
                                </span>
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
            showReplyFor(id) {
                this.data.comment = id;
            },

            saveReply() {
                axios.post('/api/notes', this.data)
                    .then(response => {
                        this.refresh();
                        this.data.note = null;
                        this.data.comment = null;
                    });
            },

            refresh() {
                let ticket = this.ticket;

                axios.get(`/api/comments/${ticket}`)
                    .then(response => {
                        this.replies = response.data;
                    });
            },

            destroy(id) {
                axios.delete(`/api/comments/${id}`)
                    .then(response => {
                        for (let key in this.replies) {
                            let reply = this.replies[key];

                            if (reply.id === id) {
                                this.replies.splice(key, 1);
                            }
                        }
                    })
            }
        }
    }
</script>
