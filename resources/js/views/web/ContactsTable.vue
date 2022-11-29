<template>
	<div>
        <card>
            <template v-slot:header>
                <div class="bg--gray d-flex">
                    <h6 class="fntwght--semibold">All Contacts</h6>                     
                </div>
            </template>
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
            showSelect
            order-by="id"
            @load="load"
            >

                <template v-slot:body="{ items }">
                    <tr v-for="item in items">
                        <td>{{ item.id }}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.surname }}</td>
                        <td>{{ item.firstname }}</td>
                        <td>{{ item.middleinitial }}</td>
                        <td>{{ item.organization }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.landline }}</td>
                        <td>{{ item.number }}</td>
                        <td>{{ item.location }}</td>
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
                            :message="'Are you sure you want to archive Page #' + item.id + '?'"
                            :alt-message="'Are you sure you want to restore Page #' + item.id + '?'"
                            @load="load"
                            @success="sync"
                            ></action-button>
                        </td>
                    </tr>
                </template>

            </data-table>
        </card>

        <div class="col-12 px-0 align-r">
            <action-button type="submit" data-toggle="modal" data-target="#exampleModalCenter" :disabled="loading" class="btn frm-btn type-1">REQUEST INFORMATION</action-button>
            
            <action-button
            v-if="item.archiveUrl && item.restoreUrl"
            color="btn-danger"
            alt-color="btn-warning"
            :action-url="item.archiveUrl"
            :alt-action-url="item.restoreUrl"
            label="Archive"
            alt-label="Restore"
            :show-alt="item.deleted_at"
            confirm-dialog
            title="Archive Item"
            alt-title="Restore Item"
            :message="'Are you sure you want to archive User #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore User #' + item.id + '?'"
            :disabled="loading"
            @load="load"
            @success="fetch"
            ></action-button>
            
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

        <loader :loading="loading"></loader>
	</div>
</template>

<script type="text/javascript">
import CrudMixin from '../../mixins/crud.js';
import ListMixin from '../../mixins/list.js';

import SearchForm from '../../components/forms/SearchForm.vue';
import ActionButton from '../../components/buttons/ActionButton.vue';
import ViewButton from '../../components/buttons/ViewButton.vue';

export default {
    computed: {
        headers() {
            return [
                { text: '#', value: 'id' },
                { text: 'Title', value: 'title' },
                { text: 'Surname', value: 'surname' },
                { text: 'Firstname', value: 'firstname' },
                { text: 'M.I.', value: 'middleinitial' },
                { text: 'Organization', value: 'organization' },
                { text: 'Primary Email', value: 'email' },
                { text: 'Landline', value: 'landline' },
                { text: 'Mobile No.', value: 'number' },
                { text: 'Location', value: 'location' },
            ];
        }
    },

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
    },

    mixins: [ ListMixin, CrudMixin ],
}
</script>