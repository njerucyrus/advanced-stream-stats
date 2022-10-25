<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StatItem from '@/Layouts/StatItem.vue'
import PaymentForm from '@/Layouts/PaymentForm.vue'
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    'plans':Object,
    'token':String
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            <li v-for="plan in plans" :key="plan.id" class="mt-2">
                        
                                {{plan.name}} ${{plan.price}} for {{plan.billingFrequency}} months
                            </li>
                        
                        </ul>
                        
                        <div class="flex flex-col">
                            <h2 class="mt-4 text-2xl font-bold">Your Stream Stats</h2>
                        
                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                <StatItem title="Messages" value="400"></StatItem>
                                <StatItem title="Messages" value="400"></StatItem>
                                <StatItem title="Messages" value="400"></StatItem>
                                <StatItem title="Messages" value="400"></StatItem>
                            </div>
                        
                            <PaymentForm></PaymentForm>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </AuthenticatedLayout>
</template>
