<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
        <card>
            <template v-slot:header>
                <div class="bg--gray">
                    <h6 class="fntwght--semibold">Profile Information</h6>                    
                </div>
            </template>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col col-3">
                    <p>Name</p>
                </div>
                <div class="frm-prfl__col col-9 d-flex">
                    <div class="col-11 px-0">
                        <input v-model="item.name" name="name" type="text" :disabled="disabled">
                    </div>
                    <div class="col-1 px-0 align-r">
                        <template v-if="disabled = disabled">
                            <p @click="disabled = !disabled" class="frm-edit">Edit <i class="fa fa-pen"></i></p>
                        </template>
                    </div>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Email</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input v-model="item.email" name="email" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Password</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="password" type="text" disabled="" value="*************">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Change Password</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <a href="/dashboard/change-password">changepassword</a>
                </div>
            </div>
        </card>
        <template v-if="disabled == false">
            <div class="col-12 px-0 align-r">
                <action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4">Save Changes</action-button>
            </div>
        </template>

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
        }
    },

    data() {
        return {
            user_classification: [],
            disabled: true,
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