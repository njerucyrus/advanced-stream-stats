<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StatItem from '@/Layouts/StatItem.vue'
import PaymentForm from '@/Layouts/PaymentForm.vue'
import CheckoutUI from '@/Layouts/CheckoutUI.vue'
import Pricing from './Pricing.vue'
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    'plans':Object

});






</script>

<template>

    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Pricing :plans=plans></Pricing>
                </div>
            </div>
        </div>
    
    </AuthenticatedLayout>
</template>
<style scoped>
#pricing-block-5{
        height: 300px;
        padding-top: 55px;
    }

    @media (min-width: 992px) {
        #pricing-block-5 {
            height: 400px;
            padding-top: 80px;
        }
    }

    .background-radial-gradient {
        background-color: hsl(218, 41%, 15%);
        background-image: radial-gradient(650px circle at 0% 0%,
                hsl(218, 41%, 35%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(218, 41%, 45%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%);
    }
</style>