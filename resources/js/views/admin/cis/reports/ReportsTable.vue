<template>
	<div>
        <form-request :submit-url="exportUrl" @load="load" submit-on-success method="POST" :action="exportUrl">
            <filter-box @refresh="fetch">
                <template v-slot:left>
                </template>
                <template v-slot:right>
                    
                    <selector
                    v-if="categories"
                    class="mt-2"
                    name="category"
                    :items="categories"
                    v-model="category"
                    @change="filter($event, 'category')"
                    placeholder="Filter by contact category"
                    item-value="id"
                    item-text="name"
                    ></selector>

                    <action-button v-if="exportUrl" type="submit" :disabled="loading" class="btn-warning mr-2" icon="fa fa-download">Export</action-button>

                </template>
            </filter-box>
        </form-request>

        <!-- DATATABLE -->
        <template v-if="category != 0">
            <data-table
            ref="data-table"
            :headers="headers"
            :filters="filters"
            :fetch-url="fetchUrl"
            :no-action="true"
            :disabled="disabled"
            order-by="id"
            @load="load"
            >

                <template v-slot:body="{ items }">
                    <tr v-for="item in items" >
                        <td>{{ item.id }}</td>
                        <td v-for="data in item.rows">{{ data.value }}</td>
                    </tr>
                </template>

            </data-table>
        </template>
        <loader :loading="loading"></loader>
	</div>
</template>

<script type="text/javascript">
import ListMixin from 'Mixins/list.js';

import SearchForm from 'Components/forms/SearchForm.vue';
import ActionButton from 'Components/buttons/ActionButton.vue';
import ViewButton from 'Components/buttons/ViewButton.vue';
import Select from 'Components/inputs/Select.vue';
import FormRequest from 'Components/forms/FormRequest.vue';

export default {
    mounted() {
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
                        value: column.name
                    }

                    header.push(column);
                })
            }
        }, 1000)
        this.$refs['data-table'].newHeaderSetter = [];
        this.$refs['data-table'].newHeaderSetter = header;
    },

    watch: {
        category(val) {
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
                            value: column.name
                        }

                        header.push(column);
                    })
                }
            }, 500)

            this.$refs['data-table'].newHeaderSetter = [];
            this.$refs['data-table'].newHeaderSetter = header;
        }
    },

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
        'selector': Select,
        'form-request': FormRequest,
    },

    mixins: [ ListMixin ],

    data() {
        return {
            category: this.categories ? this.categories[0].id : 0,
            rows: [],
        }
    },

    props: {
        exportUrl: String,
        categories: Array
    }
}
</script>