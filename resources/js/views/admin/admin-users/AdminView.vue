<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
        <card>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col col-3">
                    <p>First Name</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.first_name" name="first_name" type="text" placeholder="type here">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Last Name</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.last_name" name="last_name" type="text">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Email Address</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.email" name="email" type="text">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Roles</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <selector v-if="editable"
                    v-model="roleIds"
                    name="role_ids[]"
                    :items="roles"
                    item-value="id"
                    item-text="name"
                    empty-text="None"
                    placeholder="Please select a role"
                    multiple
                    ></selector>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Avatar</p>
                </div>
                <div class="frm-prfl__col col-9 img-picker">
                    <image-picker
                    :value="item.renderImage"
                    name="image_path"
                    placeholder="Choose a File"
                    ></image-picker>
                </div>
            </div>
            
        </card>
        <div class="col-12 px-0 align-r mt-4">
            <action-button
            v-if="item.archiveUrl && item.restoreUrl"
            color="btn frm-btn type-2 px-4 ml-2"
            alt-color="btn-warning"
            :action-url="item.archiveUrl"
            :alt-action-url="item.restoreUrl"
            label="Archive"
            alt-label="Restore"
            :show-alt="item.deleted_at"
            confirm-dialog
            title="Archive Item"
            alt-title="Restore Item"
            :message="'Are you sure you want to archive Admin #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore Admin #' + item.id + '?'"
            :disabled="loading"
            @load="load"
            @success="fetch"
            ></action-button>

            <action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4 ml-2">Save Changes</action-button>            
        </div>

        <loader :loading="loading"></loader>

    </form-request>
</template>

<script type="text/javascript">
import CrudMixin from '../../../mixins/crud.js';

import ActionButton from '../../../components/buttons/ActionButton.vue';
import Select from '../../../components/inputs/Select.vue';
import ImagePicker from '../../..//components/inputs/ImagePicker.vue'

export default {
    methods: {
        fetchSuccess(data) {
            this.item = data.item ? data.item : this.item;
            this.roles = data.roles ? data.roles : this.roles;
            this.roleIds = data.roleIds ? data.roleIds : this.roleIds;
        },
    },

    props: {
        editable: {
            default: true,
        },
    },

    data() {
        return {
            roles: [],
            roleIds: [],
        }
    },

    components: {
        'action-button': ActionButton,
        'selector': Select,
        'image-picker': ImagePicker,
    },

    mixins: [ CrudMixin ],
}
</script>