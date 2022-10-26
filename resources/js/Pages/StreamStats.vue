<script setup>
 defineProps({
    stats: Object
 })
</script>


<template>
       <Head title="Stream Stats" />
       <AuthenticatedLayout>
        <div class="py-12">
            <div class="aleart alert-success" v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>
            <div class="aleart alert-danger" v-if="$page.props.flash.error">{{ $page.props.flash.error }}</div>
            statics dashboard here
        </div>
       </AuthenticatedLayout>
</template>
