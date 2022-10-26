<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StatItem from '@/Layouts/StatItem.vue'
import BarChart from '@/Layouts/BarChart.vue'
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    'stats': Object

});

</script>

<template>
<Head title="Twitch Stats" />

<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TwitchStats
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex flex-col">
                            <h2 class="mt-4 text-2xl font-bold">Your Twitch stats</h2>
                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                <StatItem title="Total viewers" value="36.5K"></StatItem>
                                <StatItem title="Channels" value="16"></StatItem>
                                <StatItem title="Active Streamers" value="45K"></StatItem>
                                <StatItem title="Watch Time" value="3674 hours"></StatItem>
                            </div>
                            <div class="mt-4 container col-md-6">
                                <BarChart></BarChart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </AuthenticatedLayout>
</template>