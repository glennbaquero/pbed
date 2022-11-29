<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
        <card>
            <template v-slot:header>
                <div class="bg--gray">
                    <h6 class="fntwght--semibold">AFFILIATION : Employee</h6>
                </div>
            </template>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col col-3">
                    <p>Title</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="title" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Affiliation*</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="affiliation" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Position*</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="position" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Surname</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="surname" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Firstname</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="firstname" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Middle Initial</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="middleinitial" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Nickname</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="nickname" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Organization</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="organization" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Acronym</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="acronym" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Designation</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="designation" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-12">
                    <p>Email Address</p>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Primary</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="primaryemail" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Secondary</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="secondaryemail" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-12">
                    <p>Landline</p>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Primary</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="primarylandline" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Secondary</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="secondarylandline" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Other</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="otherlandline" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-12">
                    <p>Mobile Number</p>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Primary</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="primarynum" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Secondary</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="secondarynum" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Other</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="othernum" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Sector</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="sector" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Sub-sector</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="subsector" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Location by City</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="city" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Region</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="region" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Confidentiality</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="confidentiality" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Type</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="type" type="text" disabled="">
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Sources</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <input name="sources" type="text" disabled="">
                </div>
            </div>
        </card>

        <card>
            <template v-slot:header>
                <div class="bg--light-gray">
                    <h6 class="fntwght--semibold">Notes</h6>
                </div>
            </template>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col textarea">
                    <textarea>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                    <div class="align-r">
                        <p>Message 1000 words</p>
                    </div>
                </div>
            </div>
        </card>

        <card>
            <template v-slot:header>
                <div class="bg--gray">
                    <h6 class="fntwght--semibold">Request Edit Contact Information</h6>
                </div>
            </template>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col textarea">
                    <textarea>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                </div>
            </div>
        </card>
        <div class="col-12 px-0">
            <action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-5">SUBMIT</action-button>
            
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

        <loader :loading="loading"></loader>

    </form-request>
</template>

<script type="text/javascript">
import CrudMixin from 'Mixins/crud.js';
import ActionButton from 'Components/buttons/ActionButton.vue';

export default {
    methods: {
    },

    data() {
        return {
        }
    },

    components: {
        'action-button': ActionButton,
    },

    mixins: [ CrudMixin ],
}
</script>