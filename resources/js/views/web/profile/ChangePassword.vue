<template>
    <form-request :submit-url="submitUrl" @load="load" reset-on-success confirm-dialog sync-on-success>
        <card>
            <template v-slot:header>
                <div class="bg--gray">
                    <h6 class="fntwght--semibold">Change Password</h6>                    
                </div>
            </template>

            <div class="row width--45 l-padding-tb">
                <password
                label="Current"
                name="current_password"
                placeholder="enter current password"
                ></password>

                <password
                label="New"
                name="new_password"
                placeholder="enter your password"
                ></password>

                <password
                label="Confirm"
                name="new_password_confirmation"
                placeholder="enter your new password"
                ></password>

                <div class="col-12">
                    <action-button type="submit" :loading="loading" :disabled="loading" class="btn frm-btn type-1 type-white px-4">SAVE CHANGES</action-button>
                </div>
            </div>
        </card>

    </form-request>
</template>

<script type="text/javascript">
import CrudMixin from '../../../mixins/crud.js';
import Password from '../../../components/inputs/Password.vue';

export default {
	components: {
		'password': Password,
	},

    mixins: [ CrudMixin ],
}
</script>