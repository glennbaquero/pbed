<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
        <card>
            <!-- <template v-slot:header>
                <div class="bg--gray">
                    <h6 class="fntwght--semibold">Profile Information</h6>
                </div>
            </template> -->
            <div class="frm-prfl__row">
                <div class="frm-prfl__col col-3">
                    <p>Name</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.name" name="name" type="text" placeholder="type here">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Position</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.position" name="position" type="text" placeholder="type here">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>User Classification</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <selector
                    v-model="item.user_classification_id"
                    name="user_classification_ids[]"
                    :items="user_classification"
                    item-value="id"
                    item-text="name"
                    empty-text="None"
                    multiple
                    placeholder="Please select a user classification"
                    ></selector>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Status</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <select v-model="item.status" name="status" placeholder="select status">
                        <option value="1">Active</option>
                        <option value="0">Deactivated</option>
                    </select>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Email</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.email" name="email" type="text" placeholder="sample@gmail.com">
                </div>
            </div>
        </card>

        <div class="col-12 px-0 align-r mt-4">
            <a href="" v-if="!item.archiveUrl && !item.restoreUrl" class="btn frm-btn type-3 px-4 ml-2">CANCEL</a>
            
            <action-button
            v-if="item.archiveUrl && item.restoreUrl"
            color="btn frm-btn type-2 px-4 ml-2"
            alt-color="btn-warning"
            :action-url="item.archiveUrl"
            :alt-action-url="item.restoreUrl"
            label="ARCHIVE"
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

            <action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4 ml-2">SAVE NEW USER</action-button>
        </div>

        <loader :loading="loading"></loader>

    </form-request>
</template>

<script type="text/javascript">
import CrudMixin from 'Mixins/crud.js';
import ActionButton from 'Components/buttons/ActionButton.vue';
import Select from 'Components/inputs/Select.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue';
import BirthdayPicker from 'Components/inputs/BirthdayPicker.vue';
import ContactNumber from 'Components/inputs/ContactNumber.vue';

export default {
    methods: {
        fetchSuccess(data) {
            this.item = data.item ? data.item : this.item;
            this.user_classification = data.user_classification ? data.user_classification : this.item
        },
    },

    data() {
        return {
            user_classification: [],
        }
    },

    components: {
        'action-button': ActionButton,
        'selector': Select,
        'image-picker': ImagePicker,
        'birthday-picker': BirthdayPicker,
        'contact-number': ContactNumber,
    },

    mixins: [ CrudMixin ],
}
</script>