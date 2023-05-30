<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Icon } from "@iconify/vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template v-slot:header>
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        </template>

        <div class="space-y-4">
            <div
                class="focus-visible:ring-ring mt-2 space-y-4 ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
            >
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div
                        class="rounded-lg border bg-white text-gray-700 shadow-sm"
                    >
                        <div
                            class="flex flex-row items-center justify-between space-y-0 p-6 pb-2"
                        >
                            <h3 class="text-sm font-medium tracking-tight">
                                Total Revenue
                            </h3>
                            <Icon
                                icon="fluent:money-24-regular"
                                class="h-5 w-5 text-gray-700"
                            />
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold">$45,231.89</div>
                            <p class="text-xs text-gray-700">
                                +20.1% from last month
                            </p>
                        </div>
                    </div>
                    <div
                        class="rounded-lg border bg-white text-gray-700 shadow-sm"
                    >
                        <div
                            class="flex flex-row items-center justify-between space-y-0 p-6 pb-2"
                        >
                            <h3 class="text-sm font-medium tracking-tight">
                                Subscriptions
                            </h3>
                            <Icon
                                icon="fluent:people-24-regular"
                                class="h-5 w-5 text-gray-700"
                            />
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold">+2350</div>
                            <p class="text-xs text-gray-700">
                                +180.1% from last month
                            </p>
                        </div>
                    </div>
                    <div
                        class="rounded-lg border bg-white text-gray-700 shadow-sm"
                    >
                        <div
                            class="flex flex-row items-center justify-between space-y-0 p-6 pb-2"
                        >
                            <h3 class="text-sm font-medium tracking-tight">
                                Sales
                            </h3>
                            <Icon
                                icon="fluent:wallet-credit-card-24-regular"
                                class="h-5 w-5 text-gray-700"
                            />
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold">+12,234</div>
                            <p class="text-xs text-gray-700">
                                +19% from last month
                            </p>
                        </div>
                    </div>
                    <div
                        class="rounded-lg border bg-white text-gray-700 shadow-sm"
                    >
                        <div
                            class="flex flex-row items-center justify-between space-y-0 p-6 pb-2"
                        >
                            <h3 class="text-sm font-medium tracking-tight">
                                Active Now
                            </h3>
                            <Icon
                                icon="fluent:pulse-24-regular"
                                class="h-5 w-5 text-gray-700"
                            />
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold">+573</div>
                            <p class="text-xs text-gray-700">
                                +201 since last hour
                            </p>
                        </div>
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
                    <div
                        class="col-span-4 rounded-lg border bg-white text-gray-700 shadow-sm"
                    >
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3
                                class="text-lg font-semibold leading-none tracking-tight"
                            >
                                Overview
                            </h3>
                        </div>
                        <div class="p-6 pl-2 pt-0">
                            <div
                                class="recharts-responsive-container"
                                style="width: 100%; height: 350px; min-width: 0"
                                width="519.0625"
                                height="350"
                            >
                                <div
                                    class="recharts-wrapper"
                                    role="region"
                                    style="
                                        position: relative;
                                        cursor: default;
                                        width: 519px;
                                        height: 350px;
                                    "
                                >
                                    <svg
                                        class="recharts-surface"
                                        width="519"
                                        height="350"
                                        viewBox="0 0 519 350"
                                    >
                                        <title></title>
                                        <desc></desc>
                                        <defs>
                                            <clipPath id="recharts1-clip">
                                                <rect
                                                    x="65"
                                                    y="5"
                                                    height="310"
                                                    width="449"
                                                ></rect>
                                            </clipPath>
                                        </defs>
                                        <g
                                            class="recharts-layer recharts-cartesian-axis recharts-xAxis xAxis"
                                        >
                                            <g
                                                class="recharts-cartesian-axis-ticks"
                                            >
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="83.70833333333333"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="83.70833333333333"
                                                            dy="0.71em"
                                                        >
                                                            Jan
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="121.12499999999999"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="121.12499999999999"
                                                            dy="0.71em"
                                                        >
                                                            Feb
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="158.54166666666666"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="158.54166666666666"
                                                            dy="0.71em"
                                                        >
                                                            Mar
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="195.95833333333334"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="195.95833333333334"
                                                            dy="0.71em"
                                                        >
                                                            Apr
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="233.375"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="233.375"
                                                            dy="0.71em"
                                                        >
                                                            May
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="270.79166666666663"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="270.79166666666663"
                                                            dy="0.71em"
                                                        >
                                                            Jun
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="308.2083333333333"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="308.2083333333333"
                                                            dy="0.71em"
                                                        >
                                                            Jul
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="345.62499999999994"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="345.62499999999994"
                                                            dy="0.71em"
                                                        >
                                                            Aug
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="383.04166666666663"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="383.04166666666663"
                                                            dy="0.71em"
                                                        >
                                                            Sep
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="420.4583333333333"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="420.4583333333333"
                                                            dy="0.71em"
                                                        >
                                                            Oct
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="457.87499999999994"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="457.87499999999994"
                                                            dy="0.71em"
                                                        >
                                                            Nov
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="bottom"
                                                        width="449"
                                                        height="30"
                                                        x="495.29166666666663"
                                                        y="323"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="middle"
                                                    >
                                                        <tspan
                                                            x="495.29166666666663"
                                                            dy="0.71em"
                                                        >
                                                            Dec
                                                        </tspan>
                                                    </text>
                                                </g>
                                            </g>
                                        </g>
                                        <g
                                            class="recharts-layer recharts-cartesian-axis recharts-yAxis yAxis"
                                        >
                                            <g
                                                class="recharts-cartesian-axis-ticks"
                                            >
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="left"
                                                        width="60"
                                                        height="310"
                                                        x="57"
                                                        y="315"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="end"
                                                    >
                                                        <tspan
                                                            x="57"
                                                            dy="0.355em"
                                                        >
                                                            $0
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="left"
                                                        width="60"
                                                        height="310"
                                                        x="57"
                                                        y="237.5"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="end"
                                                    >
                                                        <tspan
                                                            x="57"
                                                            dy="0.355em"
                                                        >
                                                            $1500
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="left"
                                                        width="60"
                                                        height="310"
                                                        x="57"
                                                        y="160"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="end"
                                                    >
                                                        <tspan
                                                            x="57"
                                                            dy="0.355em"
                                                        >
                                                            $3000
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="left"
                                                        width="60"
                                                        height="310"
                                                        x="57"
                                                        y="82.5"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="end"
                                                    >
                                                        <tspan
                                                            x="57"
                                                            dy="0.355em"
                                                        >
                                                            $4500
                                                        </tspan>
                                                    </text>
                                                </g>
                                                <g
                                                    class="recharts-layer recharts-cartesian-axis-tick"
                                                >
                                                    <text
                                                        stroke="none"
                                                        font-size="12"
                                                        orientation="left"
                                                        width="60"
                                                        height="310"
                                                        x="57"
                                                        y="9"
                                                        fill="#888888"
                                                        class="recharts-text recharts-cartesian-axis-tick-value"
                                                        text-anchor="end"
                                                    >
                                                        <tspan
                                                            x="57"
                                                            dy="0.355em"
                                                        >
                                                            $6000
                                                        </tspan>
                                                    </text>
                                                </g>
                                            </g>
                                        </g>
                                        <g class="recharts-layer recharts-bar">
                                            <g
                                                class="recharts-layer recharts-bar-rectangles"
                                            >
                                                <g class="recharts-layer">
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="59.00333333333336"
                                                            name="Jan"
                                                            x="68.74166666666666"
                                                            y="255.99666666666664"
                                                            class="recharts-rectangle"
                                                            d="M68.74166666666666,259.99666666666667A 4,4,0,0,1,72.74166666666666,255.99666666666664L 93.74166666666666,255.99666666666664A 4,4,0,0,1,
        97.74166666666666,259.99666666666667L 97.74166666666666,315L 68.74166666666666,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="215.03666666666666"
                                                            name="Feb"
                                                            x="106.15833333333332"
                                                            y="99.96333333333334"
                                                            class="recharts-rectangle"
                                                            d="M106.15833333333332,103.96333333333334A 4,4,0,0,1,110.15833333333332,99.96333333333334L 131.1583333333333,99.96333333333334A 4,4,0,0,1,
        135.1583333333333,103.96333333333334L 135.1583333333333,315L 106.15833333333332,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="201.5"
                                                            name="Mar"
                                                            x="143.575"
                                                            y="113.5"
                                                            class="recharts-rectangle"
                                                            d="M143.575,117.5A 4,4,0,0,1,147.575,113.5L 168.575,113.5A 4,4,0,0,1,
        172.575,117.5L 172.575,315L 143.575,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="110.15333333333331"
                                                            name="Apr"
                                                            x="180.99166666666667"
                                                            y="204.8466666666667"
                                                            class="recharts-rectangle"
                                                            d="M180.99166666666667,208.8466666666667A 4,4,0,0,1,184.99166666666667,204.8466666666667L 205.99166666666667,204.8466666666667A 4,4,0,0,1,
        209.99166666666667,208.8466666666667L 209.99166666666667,315L 180.99166666666667,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="104.935"
                                                            name="May"
                                                            x="218.40833333333333"
                                                            y="210.065"
                                                            class="recharts-rectangle"
                                                            d="M218.40833333333333,214.065A 4,4,0,0,1,222.40833333333333,210.065L 243.40833333333333,210.065A 4,4,0,0,1,
        247.40833333333333,214.065L 247.40833333333333,315L 218.40833333333333,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="57.29833333333329"
                                                            name="Jun"
                                                            x="255.825"
                                                            y="257.7016666666667"
                                                            class="recharts-rectangle"
                                                            d="M255.825,261.7016666666667A 4,4,0,0,1,259.825,257.7016666666667L 280.825,257.7016666666667A 4,4,0,0,1,
        284.825,261.7016666666667L 284.825,315L 255.825,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="90.00333333333336"
                                                            name="Jul"
                                                            x="293.2416666666667"
                                                            y="224.99666666666664"
                                                            class="recharts-rectangle"
                                                            d="M293.2416666666667,228.99666666666664A 4,4,0,0,1,297.2416666666667,224.99666666666664L 318.2416666666667,224.99666666666664A 4,4,0,0,1,
        322.2416666666667,228.99666666666664L 322.2416666666667,315L 293.2416666666667,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="249.86"
                                                            name="Aug"
                                                            x="330.6583333333333"
                                                            y="65.13999999999999"
                                                            class="recharts-rectangle"
                                                            d="M330.6583333333333,69.13999999999999A 4,4,0,0,1,334.6583333333333,65.13999999999999L 355.6583333333333,65.13999999999999A 4,4,0,0,1,
        359.6583333333333,69.13999999999999L 359.6583333333333,315L 330.6583333333333,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="266.7033333333333"
                                                            name="Sep"
                                                            x="368.075"
                                                            y="48.29666666666669"
                                                            class="recharts-rectangle"
                                                            d="M368.075,52.29666666666669A 4,4,0,0,1,372.075,48.29666666666669L 393.075,48.29666666666669A 4,4,0,0,1,
        397.075,52.29666666666669L 397.075,315L 368.075,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="152.82999999999998"
                                                            name="Oct"
                                                            x="405.4916666666667"
                                                            y="162.17000000000002"
                                                            class="recharts-rectangle"
                                                            d="M405.4916666666667,166.17000000000002A 4,4,0,0,1,409.4916666666667,162.17000000000002L 430.4916666666667,162.17000000000002A 4,4,0,0,1,
        434.4916666666667,166.17000000000002L 434.4916666666667,315L 405.4916666666667,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="228.00500000000002"
                                                            name="Nov"
                                                            x="442.9083333333333"
                                                            y="86.99499999999998"
                                                            class="recharts-rectangle"
                                                            d="M442.9083333333333,90.99499999999998A 4,4,0,0,1,446.9083333333333,86.99499999999998L 467.9083333333333,86.99499999999998A 4,4,0,0,1,
        471.9083333333333,90.99499999999998L 471.9083333333333,315L 442.9083333333333,315Z"
                                                        ></path>
                                                    </g>
                                                    <g
                                                        class="recharts-layer recharts-bar-rectangle"
                                                        role="img"
                                                    >
                                                        <path
                                                            fill="#adfa1d"
                                                            radius="4,4,0,0"
                                                            width="29"
                                                            height="204.08333333333331"
                                                            name="Dec"
                                                            x="480.325"
                                                            y="110.91666666666667"
                                                            class="recharts-rectangle"
                                                            d="M480.325,114.91666666666667A 4,4,0,0,1,484.325,110.91666666666667L 505.325,110.91666666666667A 4,4,0,0,1,
        509.325,114.91666666666667L 509.325,315L 480.325,315Z"
                                                        ></path>
                                                    </g>
                                                </g>
                                            </g>
                                            <g class="recharts-layer"></g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-3 rounded-lg border bg-white text-gray-700 shadow-sm"
                    >
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3
                                class="text-lg font-semibold leading-none tracking-tight"
                            >
                                Recent Sales
                            </h3>
                            <p class="text-sm text-gray-700">
                                You made 265 sales this month.
                            </p>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="space-y-8">
                                <div class="flex items-center">
                                    <span
                                        class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded-full"
                                        ><img
                                            class="aspect-square h-full w-full"
                                            alt="Avatar"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    /></span>
                                    <div class="ml-4 space-y-1">
                                        <p
                                            class="text-sm font-medium leading-none"
                                        >
                                            Olivia Martin
                                        </p>
                                        <p class="text-sm text-gray-700">
                                            olivia.martin@email.com
                                        </p>
                                    </div>
                                    <div class="ml-auto font-medium">
                                        +$1,999.00
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="relative flex h-9 w-9 shrink-0 items-center justify-center space-y-0 overflow-hidden rounded-full border"
                                        ><img
                                            class="aspect-square h-full w-full"
                                            alt="Avatar"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    /></span>
                                    <div class="ml-4 space-y-1">
                                        <p
                                            class="text-sm font-medium leading-none"
                                        >
                                            Jackson Lee
                                        </p>
                                        <p class="text-sm text-gray-700">
                                            jackson.lee@email.com
                                        </p>
                                    </div>
                                    <div class="ml-auto font-medium">
                                        +$39.00
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded-full"
                                        ><img
                                            class="aspect-square h-full w-full"
                                            alt="Avatar"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    /></span>
                                    <div class="ml-4 space-y-1">
                                        <p
                                            class="text-sm font-medium leading-none"
                                        >
                                            Isabella Nguyen
                                        </p>
                                        <p class="text-sm text-gray-700">
                                            isabella.nguyen@email.com
                                        </p>
                                    </div>
                                    <div class="ml-auto font-medium">
                                        +$299.00
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded-full"
                                        ><img
                                            class="aspect-square h-full w-full"
                                            alt="Avatar"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    /></span>
                                    <div class="ml-4 space-y-1">
                                        <p
                                            class="text-sm font-medium leading-none"
                                        >
                                            William Kim
                                        </p>
                                        <p class="text-sm text-gray-700">
                                            will@email.com
                                        </p>
                                    </div>
                                    <div class="ml-auto font-medium">
                                        +$99.00
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded-full"
                                        ><img
                                            class="aspect-square h-full w-full"
                                            alt="Avatar"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    /></span>
                                    <div class="ml-4 space-y-1">
                                        <p
                                            class="text-sm font-medium leading-none"
                                        >
                                            Sofia Davis
                                        </p>
                                        <p class="text-sm text-gray-700">
                                            sofia.davis@email.com
                                        </p>
                                    </div>
                                    <div class="ml-auto font-medium">
                                        +$39.00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
