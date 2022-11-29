<template>
	<div v-if="$slots['header'] || $slots['default'] || $slots['footer']" class="card">
        <div v-show="$slots['header']" class="card-header">
            <slot name="header"></slot>
        </div>

        <div v-show="$slots['default']" class="card-body">
			<slot></slot>
        </div>
		
		<div v-show="$slots['footer']" class="card-footer">
        	<div class="float-right">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>