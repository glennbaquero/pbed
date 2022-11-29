<template>
	<div class="col-12">
		<div class="frm--input s-margin-b">
		    <label class="frm--label"><span>{{ label }}</span>
		        <input class="frm--password append cstm" :name="name" :type="hidden ? 'password' : 'text'" :placeholder="placeholder">
		        <div class="append-icon" @click="hidden = !hidden">
		            <i v-if="hidden" class="fa fa-eye-slash"></i>
					<i v-if="!hidden" class="fa fa-eye"></i>
		        </div>
		    </label>
		</div>
	</div>

	<!-- <div class="form-group">
		<label>{{ label }}</label>
		<div class="input-group">
			<input :placeholder="placeholder" :name="name" :type="hidden ? 'password' : 'text'" class="form-control">
			<div class="input-group-append">
                <button type="button" @click="hidden = !hidden" class="btn btn-light border">
					<i v-if="hidden" class="fa fa-eye-slash"></i>
					<i v-if="!hidden" class="fa fa-eye"></i>
				</button>
            </div>
		</div>
	</div> -->
</template>

<script type="text/javascript">
export default {
	data() {
		return {
			hidden: true,
		};
	},

	props: {
		name: String,
		label: String,
		placeholder: String,
	}
}
</script>