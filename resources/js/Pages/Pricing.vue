<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    'plans': Object

});

</script>

<template>



    <div class="py-12">
        <div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-8">

                    <p>Welcome to advanced stream stats.This app helps you to get all your twitch video stream
                        statistics in real time </p>
                </div>

                <div>
                    <div class="container my-24 px-6 mx-auto">

                        <!-- Section: Design Block -->
                        <section class="mb-32 text-gray-800">

                            <div id="pricing-block-5" class="background-radial-gradient text-center text-white">
                                <h2 class="text-3xl font-bold text-center mb-32">Pricing</h2>
                            </div>

                            <div class="grid lg:grid-cols-3 px-6 md:px-12 xl:px-32" style="margin-top: -200px">
                                <div class="p-0 m-1 py-12">
                                    <div
                                        class="block rounded-lg shadow-lg bg-white h-full lg:rounded-tr-none lg:rounded-br-none">
                                        <div class="p-6 border-b border-gray-300 text-center">
                                            <p class="uppercase mb-4 text-sm">
                                                <strong>{{ plans[1].name }}</strong>
                                            </p>
                                            <h3 class="text-2xl mb-6">
                                                <strong>$ {{ plans[1].price }}</strong>

                                                <small class="text-gray-500 text-sm">/month</small>
                                            </h3>

                                            <button type="button"
                                                class="inline-block px-6 py-2.5 bg-orange-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-700 active:shadow-lg transition duration-150 ease-in-out w-full"
                                                data-mdb-ripple="true" data-ripple-color="orange">
                                                Buy
                                            </button>
                                        </div>
                                        <div class="p-6">
                                            <ol class="list-inside">
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>10 Reports
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Export report to csv
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg> Get current month statistics
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-0 m-1">
                                    <div class="block rounded-lg shadow-lg bg-white h-full z-10">
                                        <div class="p-6 border-b border-gray-300 text-center">
                                            <p class="uppercase mb-4 text-sm">
                                                <strong>{{ plans[2].name }}</strong>
                                            </p>
                                            <h3 class="text-2xl mb-6">
                                                <strong>$ {{ plans[2].price }}</strong>
                                                <small class="text-gray-500 text-sm">/year</small>
                                            </h3>
                                            <a href="#"
                                                class="no-underline inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full">
                                                Buy
                                            </a>
                                        </div>
                                        <div class="p-6">
                                            <ol class="list-inside">
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Unlimited reports
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Export report to excel
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Export report to pdf
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Export report to csv
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Get custom date range reporting
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Premium support
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Get ranking analytics
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-0 m-1 py-10">
                                    <div
                                        class="block rounded-lg shadow-lg bg-white h-full lg:rounded-tl-none lg:rounded-bl-none">
                                        <div class="p-6 border-b border-gray-300 text-center">
                                            <p class="uppercase mb-4 text-sm">
                                                <strong>{{ plans[0].name }}</strong>
                                            </p>
                                            <h3 class="text-2xl mb-6">
                                                <strong>$ {{ plans[0].price }}</strong>
                                                <small class="text-gray-500 text-sm">/year</small>
                                            </h3>
                                            <button type="button"
                                                class="text-white inline-block px-6 py-2.5 bg-green-500 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-white-700 hover:bg-green-700 focus:bg-green-700 focus:outline-none focus:ring-0 active:bg-green-700 transition duration-150 ease-in-out w-full">
                                                Buy
                                            </button>
                                        </div>
                                        <div class="p-6">
                                            <ol class="list-inside">
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>All features in enterprise
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Custom branding on the reports
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>24/7 hr support
                                                </li>
                                                <li class="mb-4 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="check" class="text-green-600 w-4 h-4 mr-2" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                                                        </path>
                                                    </svg>Forecast insights
                                                </li>

                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Section: Design Block -->

                    </div>
                    <!-- Container for demo purpose -->
                </div>
            </div>
        </div>
    </div>

</template>
<style scoped>
#pricing-block-5 {
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