<template>
    <div>
        <card>
            <template v-slot:header>
                <div class="bg--gray d-flex">
                    <h6 class="fntwght--semibold">All Contacts</h6>                     
                </div>
            </template>
            <form-request :submit-url="exportUrl" @load="load" submit-on-success method="POST" :action="exportUrl">
                <filter-box @refresh="fetch">
                    <template v-slot:left>
                        <action-button v-if="exportUrl" type="submit" :disabled="loading" class="btn-light border mr-2" icon="fa fa-download">Export</action-button>

                    </template>
                    <template v-slot:right>
                        <div class="row">
                            <selector
                            v-if="categories"
                            class="col-md-6"
                            name="category"
                            :items="categories"
                            v-model="category"
                            @change="filter($event, 'category')"
                            placeholder="Filter by contact category"
                            item-value="id"
                            item-text="name"
                            ></selector>
                            <div class="col-md-6 px-0">
                                <search-form
                                @search="filter($event, 'search')">
                                </search-form>
                            </div>
                        </div>
                    </template>
                </filter-box>
            </form-request>

        <!-- DATATABLE -->
        <data-table  v-if="category != 0"
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
                <tr v-for="item in items" >
                    <td>{{ item.id }}</td>
                    <td v-for="data in item.rows">{{ data.value != null ? data.value : 'N/A' }}</td>
                    <td>
                        <view-button :href="item.showUserUrl"></view-button>
                        
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
                        :message="'Are you sure you want to archive Contact Information #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore Contact Information #' + item.id + '?'"
                        @load="load"
                        @success="sync"
                        ></action-button>
                    </td>
                </tr>
            </template>
<!-- 
            <template v-slot:body="{ items }">
                <tr v-for="item in items">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <view-button :href="item.showUrl"></view-button>
                        
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
                    </td>
                </tr>
            </template> -->

        </data-table>
    </card>

        <loader :loading="loading"></loader>
    </div>
</template>

<script type="text/javascript">
import ListMixin from 'Mixins/list.js';
import CrudMixin from 'Mixins/crud.js';


import Card from 'Components/containers/Card.vue';

import SearchForm from 'Components/forms/SearchForm.vue';
import ActionButton from 'Components/buttons/ActionButton.vue';
import ViewButton from 'Components/buttons/ViewButton.vue';
import Select from 'Components/inputs/Select.vue';
import FormRequest from 'Components/forms/FormRequest.vue';


import ConfirmProps from 'Mixins/confirm/props.js';
import ConfirmMethods from 'Mixins/confirm/methods.js';
import ResponseMixin from 'Mixins/response.js';

export default {
    mounted() {
        this.tableHeaders();
    },

    methods: {
        tableHeaders() {
            this.$refs['data-table'].filters.category = this.category;

            var header = [
                { text: '#', value: 'id' },
            ];
            var column = {};
            setTimeout(() => {
                if(this.$refs['data-table'] != undefined) {

                    var item = this.$refs['data-table'].$data.items;

                    _.each(item[0].columns, (column) => {
                        var column = {
                            text: column.name,
                            value: ''
                        }

                        header.push(column);
                    })
                }
            }, 1000)
            this.$refs['data-table'].newHeaderSetter = [];
            this.$refs['data-table'].newHeaderSetter = header;
        },

        getSelected() {
            var items = this.$refs['data-table'].items;
            var selectedItems = items.filter(x => x.selected).map(x => x.id);
            this.selected_ids = selectedItems;
        },

        selectAll(val) {
            var items = this.$refs['data-table'].items;
            _.each(items, (item) => {
                item.selected = val;
            });

            var selectedItems = items.filter(x => x.selected).map(x => x.id);
            this.selected_ids = selectedItems;
        },

        showConfirmation() {
            let message = {
                title: 'Archive Record?',
                body: 'Do you want to permanently remove this set of information to your record?',
            }

            let options = {
                loader: true,
                okText: this.okText,
                cancelText: this.cancelText,
                animation: 'fade',
                type: this.dialogType,
                verification: this.verification,
                verificationHelp: this.verificationHelp,
            };

            this.$dialog.confirm(message, options)
            .then((dialog) => {
                axios.post(this.batchUrl, this.selected_ids)
                    .then(response => {
                        this.parseSuccess(response.data.message, null, {});
                        dialog.loading(false); 
                        dialog.close();
                        this.$refs['data-table'].fetch()
                    })
            }).catch(() => {

            });
        }
    },

    computed: {
        columns() {
            let array = ['id'];

            return array;
        },
    },

    watch: {
        category(val) {
            this.tableHeaders();
        },

        selected_ids(val) {
            if(val.length) {
                this.showBatchDeletion = true;
            } else {
                this.showBatchDeletion = false;
            }
        }
    },

    data() {
        return {
            category: this.categories ? this.categories[0].id : 0,
            selected_ids: [],
            showBatchDeletion: false
        }
    },

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
        'selector': Select,
        'form-request': FormRequest,
        'card': Card,
    },

    props: {
        categories: Array,
        exportUrl: String
    },

    mixins: [ ListMixin, ConfirmProps, ConfirmMethods, ResponseMixin ],
}
</script>