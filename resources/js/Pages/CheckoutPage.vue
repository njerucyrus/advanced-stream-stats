<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatItem from '@/Layouts/StatItem.vue'
import PaymentForm from '@/Layouts/PaymentForm.vue'
import CheckoutUI from '@/Layouts/CheckoutUI.vue'


import { Head } from '@inertiajs/inertia-vue3';


const props = defineProps({
    'planId': String
})

const planId = props.planId;

</script>

<template>

    <Head title="Checkout" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Checkout
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <CheckoutUI :plan_id=planId></CheckoutUI>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>