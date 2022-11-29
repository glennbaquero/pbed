<template>
	<div>
		<template v-if="isTable">
		<div class="table-responsive">
	    	<table class="table table-hover table-bordered text-center">
	            
	            <!-- Header Slot -->
	            <slot name="header">
	            	<thead>
						<tr>
							<th v-if="showSelect">
								<label class="frm-check">
	                                <input v-model="selected" class="frm-form__check" type="checkbox" name="" required>
	                                <span class="frm-form__checkbox"></span>
	                            </label>
							</th>
							<th v-for="header in newHeaderSetter" @click="sortBy(header.value)">
								<span>{{ header.text }}</span>
								<span v-if="header.value && !sortable" class="ml-2" :class="sortIcon(header.value)"></span>
							</th>
							<th v-if="!noAction">
								{{ actionText }}
							</th>
						</tr>
					</thead>
	            </slot>

	            <!-- Body Slot -->
	            <tbody ref="sortable">
		            <slot name="body" :items="items"></slot>

		            <!-- Empty list -->
		            <tr v-if="!array_count(items) && !loading">
                        <td :colspan="colspan">{{ emptyText }}</td>
                    </tr>
		        </tbody>

	        </table>
	    </div>
	    </template>
	    <template v-if="!isTable">
			<slot name="body" :items="items"></slot>		        	
	    </template>

	    <!-- List Pagination -->
	    <div class="frm-pagination" v-if="!empty(pagination)">
		    <div class="row pt-2">
		    	<div class="col-12 col-md-6 mb-3" v-if="isTable">
		    		<div class="d-flex align-items-center form-inline">
		    			<label>Show</label>
			    		<select v-model="limit" class="form-control d-inline-block mx-2">
			    			<option v-for="limit in limits" :value="limit">{{ limit }}</option>
			    		</select>
			    		<label>Entries</label>
		    		</div>
		    	</div>
		    	<div class="col-12 col-md-6 text-sm-left text-md-right">
		    		<pagination
					v-model="page"
					:total-visible="totalVisible"
					:length="pagination.last_page"
					></pagination>
		    	</div>
		    </div>
		    <div class="row pb-2" v-if="isTable">
		    	<div class="col-12 col-md-6 d-flex align-items-center">
		    		<p class="mb-0">Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }}</p>
		    	</div>
		    	<div class="col-12 col-md-6 text-sm-left text-md-right">
		    		<div v-if="pagination.last_page > 1" class="d-inline-flex form-inline">
		    			<label>Go to Page:</label>
			    		<select v-model="page" class="form-control ml-2">
			    			<option v-for="page_number in pagination.last_page" :value="page_number">{{ page_number }}</option>
			    		</select>
		    		</div>
		    	</div>
		    </div>
	    </div>

	</div>
</template>

<script>
import ListMixin from './mixin.js';

export default {
	props: {
		isTable: {
			default: true,
			type: Boolean
		}
	},

	mixins: [ ListMixin ],
}
</script>