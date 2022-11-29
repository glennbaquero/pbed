<template>
	<div>

        <project-member-view
        :submit-url="submitUrl"
        :project-id="projectId"
        @refresh="fetch()"        
        ></project-member-view>

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
                    <td>{{ item.name }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>    
                        <template v-if="selectedId && selectedId == item.id">
                            <button 
                            @click="cancelEdit()"
                            class="btn btn-sm btn-warning">
                                <i class="fa fa-times"></i>
                            </button>
                        </template>
                        <template v-else>
                            <button 
                            @click="fetchItem(item.fetchItemUrl)"
                            class="btn btn-sm btn-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                        </template>
                        
                        <action-button
                        small 
                        color="btn-text"
                        alt-color="btn-text"
                        :show-alt="item.deleted_at"
                        :action-url="item.archiveUrl"
                        :alt-action-url="item.restoreUrl"
                        icon="fas fa-trash"
                        alt-icon="fas fa-trash-restore-alt"
                        confirm-dialog
                        :disabled="loading"
                        title="Archive Item"
                        alt-title="Restore Item"
                        :message="'Are you sure you want to archive Areas of Work #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore Areas of Work #' + item.id + '?'"
                        @load="load"
                        @success="sync"
                        ></action-button>
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
import {bus} from 'EventBus/bus.js';

import ProjectMemberView from './ProjectMemberView.vue';

export default {
    
    props: {
        projectId: {
            default: null,
            type: Number
        },
        
        submitUrl: {
            type: String,
            default: null
        },
    },

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
        'project-member-view': ProjectMemberView
    },    

    computed: {
        headers() {
            return [
                { text: '#', value: 'id' },
                { text: 'Name', value: 'name' },
                { text: 'Created Date', value: 'created_at' },
            ];
        }
    },


    data() {
        return {
            selectedId: null,
        }
    },

    mixins: [ ListMixin ],

    methods: {

        /*
        |--------------------------------------------------------------------------
        | @Methods
        |--------------------------------------------------------------------------
        */

        /**
         * Fetching item
         * 
         * @param  string url
         */
        fetchItem(url) {
            this.loading = true;

            axios.post(url)
                .then((response) => {
                    this.loading = false;                    
                    this.selectedId = response.data.item.id;
                    bus.$emit('fetchMembers', {
                        item: response.data.item
                    });

                }).catch((err) => {
                    this.loading = false;
                });

        },

        cancelEdit() {
            this.selectedId = null;
            bus.$emit('cancelEdit');
        },

    },
}
</script>