<template>
    <div class="replies create--reply no-margin-top">
        <div class="row">
            <div class="reply">
                <div class="col-sm-1">
                    <div class="image hidden-xs">
                        <img :src="image ? image : '/images/profile.jpg'">
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="panel panel-default">
                        <div class="panel-heading">Post a reply to this ticket</div>
                        <div class="panel-body">
                            <form @submit.prevent="reply" v-if="!closed">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Say something..." v-model="data.content" rows="5"></textarea>
                                </div>
                                <button class="btn btn-primary pull-right">Reply</button>
                            </form>
                            <div class="text-center" v-else>
                                <i>This ticket has been closed, to post a reply the ticket will need to be re-opened.</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ticket', 'image', 'closed'],

        created() {
            this.data.ticket = this.ticket;
        },

        data() {
            return {
                data: {
                    ticket: null,
                    content: null
                }
            };
        },

        methods: {
            reply() {
                axios.post('/api/comments', this.data)
                    .then(response => {
                        Bus.$emit('comments:refresh');
                        this.data.content = null;
                    });
            }
        }
    }
</script>
