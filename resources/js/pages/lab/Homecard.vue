<template>
<div id="app" v-if="curlab">
    <v-content>
        <div id="flex-container">
            <v-row>
                <div id="chart">
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-row>
                            <v-col>
                                <v-card :elevation="hover ? 16 : 2">
                                    <v-row>
                                        <v-icon large color="#00A8C9" class="ml-6 mx-2">whatshot</v-icon>
                                        <v-card-title style="font-family:Prompt;">อุปกรณ์ที่ถูกยืมบ่อย</v-card-title>
                                        <v-spacer></v-spacer>
                                        <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                                    </v-row>
                                    <apexchart type="bar" height="350" width="650" :options="chartOptions" :series="series"></apexchart>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-hover>
                </div>
                <div id="chart">
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-row>
                            <v-col>
                                <v-card :elevation="hover ? 16 : 2">
                                    <v-row>
                                        <v-icon large color="#00A981" class="ml-6 mx-2">donut_large</v-icon>
                                        <v-card-title style="font-family:Prompt;">สถานะคำขอยืมทั้งหมด</v-card-title>
                                        <v-spacer></v-spacer>
                                        <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                                    </v-row>
                                    <apexchart type="donut" height="363" width="650" :options="chartOptions_donut" :series="series_donut"></apexchart>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-hover>
                </div>
            </v-row>
        </div>
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
            <v-card class="mt-6 mb-6 mx-auto" max-width="420">
                <v-row>
                    <v-icon large color="#7F7DD9" class="ml-6 mx-2">block</v-icon>
                    <v-card-title style="font-family:Prompt;">อุปกรณ์ที่หมดสต็อก</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                </v-row>
                <v-card-text class="pt-0">
                    <v-data-table :headers="headers_outstock" :items="items_outstock" :items-per-page="5" class="elevation-1"></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light">สามารถตรวจสอบและเรียกดูอุปกรณ์ทั้งหมดได้ที่หน้าอุปกรณ์</span>
                </v-card-text>
            </v-card>

            <v-card class="mt-6 mb-6 mx-auto" max-width="420">
                <v-row>
                    <v-icon large color="orange accent-2" class="ml-6 mx-2">sentiment_dissatisfied</v-icon>
                    <v-card-title style="font-family:Prompt;">อุปกรณ์ที่สูญหาย</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                </v-row>
                <v-card-text class="pt-0">
                    <v-data-table :headers="headers_missing" :items="items_missing" :items-per-page="5" class="elevation-1"></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light">สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span>
                </v-card-text>
            </v-card>

            <v-card class="mt-6 mb-6 mx-auto" max-width="420">
                <v-row>
                    <v-icon large color="error" class="ml-6 mx-2">sentiment_dissatisfied</v-icon>
                    <v-card-title style="font-family:Prompt;">อุปกรณ์ที่เสียหาย</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                </v-row>
                <v-card-text class="pt-0">
                    <v-data-table :headers="headers_broken" :items="items_broken" :items-per-page="5" class="elevation-1"></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light">สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span>
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
        numberdata: [],
        headers: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equip_name"
            }
        ],

        items_outstock: [{
                equip_id: "10001",
                equip_name: "ตัวต้านทาน 500k ohm"
            },
            {
                equip_id: "10002",
                equip_name: "AC Adapter 9V"
            }
        ],

        headers_broken: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equip_name"
            },
            {
                text: "QTY",
                value: "equip_qty"
            }
        ],

        items_broken: [{
                equip_id: "10005",
                equip_name: "Servo motor",
                equip_qty: "1"
            },
            {
                equip_id: "10012",
                equip_name: "16x2 LCD Display",
                equip_qty: "1"
            }
        ],

        headers_missing: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equip_name"
            },
            {
                text: "QTY",
                value: "equip_qty"
            }
        ],

        items_missing: [{
                equip_id: "10014",
                equip_name: "LED ไฟสีแดง",
                equip_qty: "5"
            },
            {
                equip_id: "10017",
                equip_name: "ตัวต้านทานปรับค่าได้",
                equip_qty: "3"
            }
        ],
        series_donut: [44, 55, 41, 37, 17, 15],
        chartOptions_donut: {
            chart: {
              type: 'donut',
            },
            labels: ['Returned','Recieved','Ready', 'Wait','Broken', 'Missing',],
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },
                legend: {
                  position: 'bottom'
                }
              }
            }],
            colors: ['#018ffb','#785ed0', '#01e396', '#546E7A', '#ff4661', '#feb01a'
            ],
          },
          series: [{
            data: [25,22,20,18,17,15,13,12,11,10]
          }],
          chartOptions: {
            chart: {
              type: 'bar',
              height: 380
            },
            plotOptions: {
              bar: {
                barHeight: '100%',
                distributed: true,
                horizontal: true,
                dataLabels: {
                  position: 'bottom'
                },
              }
            },
            colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
              '#f48024', '#69d2e7'
            ],
            dataLabels: {
              enabled: true,
              textAnchor: 'start',
              style: {
                colors: ['#fff']
              },
              formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
              },
              offsetX: 0,
              dropShadow: {
                enabled: true
              }
            },
            stroke: {
              width: 1,
              colors: ['#fff']
            },
            xaxis: {
              categories: [
                  'Transistor 2N3904','Relay','ปุ่ม (กดติดปล่อยดับ)', 'ตัวต้านทาน 1k ohm', 'header female 2 รู', 'ตัวต้านทาน 3.3 ohm','เซนเซอร์อินฟราเรด (IR sensor)','Socket (PIC to PCB)','Servo motor','Power supply 5v'
              ],
            },
            yaxis: {
              labels: {
                show: false
              }
            },
            // title: {
            //     text: 'Custom DataLabels',
            //     align: 'center',
            //     floating: true
            // },
            // subtitle: {
            //     text: 'Category Names as DataLabels inside bars',
            //     align: 'center',
            // },
            tooltip: {
              theme: 'dark',
              x: {
                show: false
              },
              y: {
                title: {
                  formatter: function () {
                    return ''
                  }
                }
              }
            }
          },
       
    }),

    mounted() {
        this.$store.dispatch("loadRequest_details");
    },
    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        },
        request_details() {
            return this.$store.state.request_details;
        },
        // getdata(){
        //     for(i=0;i<this.request_details.length;i++){
        //     }
        // }
    },
    methods: {

    }
};
</script>

<style scoped>
div.flex-container {
    display: flex;
}

@media screen and (min-width: 1301px) {
    div.flex-container {
        flex-direction: row;
    }
}

@media screen and (max-width: 1300px) {
    div.flex-container {
        flex-direction: column;
    }
}
</style>
