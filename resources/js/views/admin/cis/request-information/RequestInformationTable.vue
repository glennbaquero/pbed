<template>
    <div>
        <filter-box @refresh="fetch">
            <template v-slot:left>
            </template>
            <template v-slot:right>

                <search-form
                @search="filter($event, 'search')">
                </search-form>

            </template>
        </filter-box>

        <!-- DATATABLE -->
        <data-table
        ref="data-table"
        :headers="headers"
        :filters="filters"
        :fetch-url="fetchUrl"
        :no-action="noAction"
        :disabled="disabled"
        order-by="id"
        @load="load"
        >

            <template v-slot:body="{ items }">
                <tr v-for="item in items">
                    <td>{{ item.id }}</td>
                    <td>{{ item.requestor }}</td>
                    <td><a :href="item.requested_contact" target="_blank">Show Contact Information</a></td>
                    <td>{{ item.status }}</td>
                    <td>
                        <span v-html="item.reason"></span>
                    </td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <template v-if="item.canArchive">
                            <action-button
                            small 
                            color="btn-text"
                            :action-url="item.approveUrl"
                            icon="fas fa-check"
                            confirm-dialog
                            :disabled="loading"
                            title="Approve Contact Request"
                            :message="'Are you sure you want to approve contact request #' + item.id + '?'"
                            @load="load"
                            @success="sync"
                            ></action-button>

                            <action-button
                            small 
                            color="btn-text"
                            :action-url="item.disapproveUrl"
                            icon="fas fa-times"
                            confirm-dialog
                            :disabled="loading"
                            title="Disapprove Contact Request"
                            :message="'Are you sure you want to contact request #' + item.id + '?'"
                            @load="load"
                            @success="sync"
                            ></action-button>
                        </template>

                        <template v-else>
                            <action-button
                            small 
                            color="btn-danger"
                            alt-color="btn-warning"
                            :show-alt="item.deleted_at"
                            :action-url="item.archiveUrl"
                            :alt-action-url="item.restoreUrl"
                            icon="fas fa-trash"
                            alt-icon="fas fa-trash-restore-alt"
                            confirm-dialog
                            :disabled="loading"
                            title="Archive Item"
                            alt-title="Restore Item"
                            :message="'Are you sure you want to archive Contact Information #' + item.id + '?'"
                            :alt-message="'Are you sure you want to restore Contact Information #' + item.id + '?'"
                            @load="load"
                            @success="sync"
                            ></action-button>
                        </template>
                    </td>
                </tr>
            </template>

        </data-table>

        <loader :loading="loading"></loader>
    </div>
</template>

<script type="text/javascript">
import ListMixin from 'Mixins/list.js';
import SearchForm from 'Components/forms/SearchForm.vue';
import ActionButton from 'Components/buttons/ActionButton.vue';
import ViewButton from 'Components/buttons/ViewButton.vue';

export default {
    computed: {
        headers() {
            let array = [
                { text: '#', value: 'id' },
                { text: 'Requestor', value: 'requestor' },
                { text: 'Requested Contact', value: 'requested_contact' },
                { text: 'Status', value: 'status' },
                { text: 'Reason', value: 'reason' },
                { text: 'Created Date', value: 'created_at' },              
            ];

            return array;
        },
    },

    props: {

        hideButtons: {
            default: false,
            type: Boolean,
        },
    },

    mixins: [ ListMixin ],

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
    },
}
</script>