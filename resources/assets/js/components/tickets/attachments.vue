<template>
    <div class="panel panel-default">
        <div class="panel-heading">Attachments</div>
        <div class="panel-body" style="padding: 0">
            <dropzone
                ref="dz"
                id="attachmentDropzone"
                :options="options"
                acceptedFileTypes="image/*,application/pdf,application/csv"
                v-on:vdropzone-success="fileUploaded"
                v-on:vdropzone-sending="sendingEvent">
            </dropzone>
        </div>
        <table class="table" v-if="attachments.length > 0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Attachment</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="attachment in attachments">
                    <td>{{ attachment.user.name }}</td>
                    <td><a :href="path + attachment.location" target="_blank">{{ attachment.location }}</a></td>
                    <td>{{ attachment.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import 'vue2-dropzone/dist/vue2Dropzone.css'

    let dropzone = require('vue2-dropzone');

    export default {
        props: ['ticket', 'path'],

        components: {
            dropzone
        },

        created() {
            this.refresh();
        },

        data() {
            return {
                attachments: [],
                options: {
                    maxFileSizeInMB: 10,
                    thumbnailWidth: 100,
                    thumbnailHeight: 100,
                    duplicateCheck: true,
                    url: '/api/attachments',
                    dictDefaultMessage: '<i class="fa fa-cloud-upload"></i> Drop or click to upload attachments.'
                }
            };
        },

        methods: {
            sendingEvent(file, xhr, formData) {
                formData.append('ticket', this.ticket);
            },

            fileUploaded(file, response) {
                this.refresh();
                
                setTimeout(() => {
                    this.$refs.dz.removeFile(file);
                }, 2500);
            },

            refresh() {
                axios.get(`/api/attachments/${this.ticket}`)
                    .then(response => {
                        this.attachments = response.data;
                    });
            }
        }
    }
</script>
