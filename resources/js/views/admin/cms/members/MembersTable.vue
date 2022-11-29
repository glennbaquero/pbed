<template>
    <div>
        <loader
            :loading="loading"
        ></loader>

        <draggable 
            v-model="items" 
            group="people" 
            @start="drag=true" 
            @end="drag=false"
            :disabled="!canReorder ? true: false"
        >
            <div v-for="(item, index) in items" :key="item.id" 
                class="form-group pt-2" 
            >

                <div class="row">
                    <div class="col-md-6 text-center">
                        <label 
                            class="badge bg-primary"
                        >{{ index+1 }}) {{ item.name }}</label>     
                       
                    </div>
                    <div class="col-md-6 text-center">
                        <view-button :href="item.showUrl"></view-button>
                        
                        <action-button
                        v-if="!hideButtons"
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
                        :message="'Are you sure you want to archive #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore #' + item.id + '?'"
                        @load="load"
                        @success="sync"
                        ></action-button>

                    </div>
                </div>

            </div>

            <template v-if="items.length === 0">
                <div class="form-group text-center">
                    <label>No data found</label>
                </div>
            </template>
        
        </draggable>

        <hr />

        <template v-if="canReorder">
            <div class="row" >
                <div class="col-md-12 text-right">
                    <button 
                    @click="saveOrder()"
                    :disbled="loading"
                    class="btn btn-primary">Save Order</button>
                </div>
            </div>
        </template>
    </div>
	<!-- <div>
        <filter-box @refresh="fetch">
            <template v-slot:left>
            </template>
            <template v-slot:right>

                <search-form
                @search="filter($event, 'search')">
                </search-form>

            </template>
        </filter-box>

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
                    <td v-for="header in headers">
                            {{ item[header.value] }}        
                    </td>
                    <td>
                        <view-button :href="item.showUrl"></view-button>
                        
                        <action-button
                        v-if="!hideButtons"
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
                        :message="'Are you sure you want to archive #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore #' + item.id + '?'"
                        @load="load"
                        @success="sync"
                        ></action-button>
                    </td>
                </tr>
            </template>

        </data-table>

        <loader :loading="loading"></loader>
	</div> -->
</template>

<script type="text/javascript">
import ListMixin from 'Mixins/list.js';
import SearchForm from 'Components/forms/SearchForm.vue';
import ActionButton from 'Components/buttons/ActionButton.vue';
import ViewButton from 'Components/buttons/ViewButton.vue';

import draggable from 'vuedraggable';
import { EventBus } from '../../../../EventBus.js';

export default {
    computed: {
        headers() {
            let array = [
                // { text: '#', value: 'id' },
                // { text: 'Name', value: 'name' },
                // { text: 'Created Date', value: 'created_at' },              
            ];

            return array;
        },
    },

    props: {

        hideButtons: {
            default: false,
            type: Boolean,
        },
        fetchUrl: String,
        submitUrl: String,
        canReorder: {
            type: Boolean,
            default: true,
        }
    },

    data() {
        return {
            items: [],
            loading: false
        }
    },

    mixins: [ ListMixin ],

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
    },

    mounted() {
        this.init();
        this.refreshList();
    },

    
    methods: {
        init() {
            this.loading = true;

            axios.post(this.fetchUrl)
                .then((response) => {
                    this.loading = false;

                    if(response.status === 200) {
                        this.items = response.data.items;
                    }
                }) .catch((error) => {
                    this.loading = false;
                    this.parseError(error);
                })
        },

        success() {
            this.init();
            EventBus.$emit('refresh');
        },

        refreshList() {
            EventBus.$on('refresh', () => {
                this.init();
            });         
        },

        saveOrder() {
            this.loading = true;
            axios.post(this.submitUrl, {'items': this.items})
                .then((response) => {
                    this.loading = false;
                    if(response.status === 200) {
                        this.parseSuccess(response.data.message);
                        this.init();
                    }

                }).catch((error) => {
                    this.loading = false;                 
                    this.parseError(error);
                });
        },
    },
}
</script>