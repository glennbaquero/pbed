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
                    <td>{{ item.name }}</td>
                    <td>{{ item.slug }}</td>
                    <td v-if="!hideParent"><a :href="item.parentUrl" target="_blank" class="btn btn-link btn-sm">{{ item.page }}</a></td>
                    <td><span class="badge" :class="item.type_class">{{ item.type }}</span></td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <view-button :href="item.showUrl"></view-button>
                    </td>
                </tr>
            </template>

        </data-table>

        <loader :loading="loading"></loader>
	</div>
</template>

<script type="text/javascript">
import ListMixin from '../../../mixins/list.js';

import SearchForm from '../../../components/forms/SearchForm.vue';
import ActionButton from '../../../components/buttons/ActionButton.vue';
import ViewButton from '../../../components/buttons/ViewButton.vue';

export default {
    computed: {
        headers() {
            let array = [
                { text: '#', value: 'id' },
                { text: 'Name', value: 'name' },
                { text: 'Slug', value: 'slug' },
            ];

            if (!this.hideParent) {
                array.push({ text: 'Page', value: 'page_id' });
            }

            array = array.concat([
                { text: 'Type', value: 'type' },
                { text: 'Created Date', value: 'created_at' },
            ]);

            return array;
        },
    },

    props: {
        hideParent: {
            default: false,
            type: Boolean,
        },

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