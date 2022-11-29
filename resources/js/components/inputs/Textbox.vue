<template>
	<div>
		<!-- <label v-if="showLabel">{{ label }}</label> -->
		<input 
		:name="name" 
		:value="value" 
		:type="type" 
		v-on:input="updateValue($event.target.value)">
	</div>
</template>
<script>

export default {

	props: {

		label: {
 			type: String,
 			default: null
		},

		name: {
 			type: String,
 			default: null
		},

		type: {
 			type: String,
 			default: 'text'
		},

		value: {
 			type: [String, Number],
 			default: null
		},		

		showLabel: {
			type: Boolean,
			default: true
		}		

	},

    model: {
        prop: 'value',
        event: 'change',
    },	

    methods: {
      updateValue: function (value) {
        this.$emit('input', value)
      }
    }

}

</script>