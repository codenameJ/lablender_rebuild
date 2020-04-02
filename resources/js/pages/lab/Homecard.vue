<template>
    <div id="app" v-if="curlab">
        <v-content>
            <div id="flex-container">
            <v-row>
            <div id="chart">
                <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                <v-card :elevation="hover ? 16 : 2">
                <span class="headline grey--text ml-5 my-5">Request Status กราฟนี้แท่ง กราฟนั้นวงกลมดีมั้ยวะ</span>
                <apexchart
                    type="bar"
                    height="350"
                    width="650"
                    :options="chartOptions"
                    :series="series"
                ></apexchart></v-card></v-hover></div>
                <div id="chart">
                <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                <v-card :elevation="hover ? 16 : 2">
                <span class="headline grey--text ml-5 my-5">Request Status เมื่อไหร่จะเลิกชิดบน</span>
                <apexchart
                    type="bar"
                    height="350"
                    width="650"
                    :options="chartOptions"
                    :series="series"
                ></apexchart></v-card></v-hover>
            </div></v-row></div>
            <!-- <div class="mx-auto mt-1 mb-2" max-width="1500">
                <v-row>
                    <div>
                        
                        <h4 class="ml-5" align="left">
                            {{ curlab.course_name }} : {{ curlab.course_id }}
                        </h4>
                    </div>
                    <v-spacer></v-spacer>
                    <h5 class="mr-5 mb-5" align="right">Welcome, professor name</h5>
                </v-row>
            </div> -->
            <div class="flex-container">
                <v-card class="mt-6 mb-6 mx-auto" max-width="500">
                    <v-sheet
                        class="v-sheet--offset mx-auto"
                        color="success"
                        elevation="12"
                        max-width="calc(100% - 32px)"
                    >
                        <v-img src="/img/frequent.png"></v-img>
                    </v-sheet>
                    <v-card-text class="pt-0">
                        <v-data-table
                            :headers="headers_frequent"
                            :items="items_frequent"
                            :items-per-page="5"
                            class="elevation-1"
                        ></v-data-table>
                        <v-divider class="my-2"></v-divider>
                        <v-icon class="mr-2" small>
                            build
                        </v-icon>
                        <span class="caption grey--text font-weight-light"
                            >สามารถตรวจสอบคำขอยืมอุปกรณ์ทั้งหมดได้ที่หน้าคำขอยืม</span
                        >
                    </v-card-text>
                </v-card>

                <v-card class="mt-6 mb-6 mx-auto" max-width="500">
                    <v-sheet
                        class="v-sheet--offset mx-auto"
                        color="error"
                        elevation="12"
                        max-width="calc(100% - 32px)"
                    >
                        <v-img src="/img/broken.png"></v-img>
                    </v-sheet>
                    <v-card-text class="pt-0">
                        <v-data-table
                            :headers="headers"
                            :items="items"
                            :items-per-page="5"
                            class="elevation-1"
                        ></v-data-table>
                        <v-divider class="my-2"></v-divider>
                        <v-icon class="mr-2" small>
                            build
                        </v-icon>
                        <span class="caption grey--text font-weight-light"
                            >สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span
                        >
                    </v-card-text>
                </v-card>

                <v-card class="mt-6 mb-6 mx-auto" max-width="500">
                    <v-sheet
                        class="v-sheet--offset mx-auto"
                        color="amber accent-4"
                        elevation="12"
                        max-width="calc(100% - 32px)"
                    >
                        <v-img src="/img/missing.png"></v-img>
                    </v-sheet>
                    <v-card-text class="pt-0">
                        <v-data-table
                            :headers="headers"
                            :items="items"
                            :items-per-page="5"
                            class="elevation-1"
                        ></v-data-table>
                        <v-divider class="my-2"></v-divider>
                        <v-icon class="mr-2" small>
                            build
                        </v-icon>
                        <span class="caption grey--text font-weight-light"
                            >สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span
                        >
                    </v-card-text>
                </v-card>
            </div>
        </v-content>
    </div>
</template>

<script>
export default {
    // props: ["course_id"],
    data: () => ({
        headers: [
            {
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            { text: "Equipment Name", value: "equip_name" },
            { text: "QTY", value: "equip_qty" }
        ],

        items: [
            {
                equip_id: "10001",
                equip_name: "Pork Belly",
                equip_qty: "1"
            },
            {
                equip_id: "10002",
                equip_name: "Jarikka Belly",
                equip_qty: "1"
            }
        ],

        headers_frequent: [
            {
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            { text: "Equipment Name", value: "equip_name" },
            { text: "Lending counts", value: "equip_counts" }
        ],

        items_frequent: [
            {
                equip_id: "10001",
                equip_name: "Pork Belly",
                equip_counts: "17"
            },
            {
                equip_id: "10002",
                equip_name: "Jarikka Belly",
                equip_counts: "15"
            }
        ],
        series: [
            {
                name: "PRODUCT A",
                data: [44, 55, 41, 67, 22, 43]
            },
            {
                name: "PRODUCT B",
                data: [13, 23, 20, 8, 13, 27]
            },
            {
                name: "PRODUCT C",
                data: [11, 17, 15, 15, 21, 14]
            },
            {
                name: "PRODUCT D",
                data: [21, 7, 25, 13, 22, 8]
            }
        ],
        chartOptions: {
            chart: {
                type: "bar",
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: "bottom",
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }
            ],
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "01/01/2011 GMT",
                    "01/02/2011 GMT",
                    "01/03/2011 GMT",
                    "01/04/2011 GMT",
                    "01/05/2011 GMT",
                    "01/06/2011 GMT"
                ]
            },
            legend: {
                position: "right",
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        }
    }),

    mounted() {
        // this.getLabData();
    },
    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        }
    }
};
</script>

<style scoped>
div.flex-container {
    display: flex;
}

@media screen and (min-width: 1641px) {
    div.flex-container {
        flex-direction: row;
    }
}

@media screen and (max-width: 1640px) {
    div.flex-container {
        flex-direction: column;
    }
}
</style>
