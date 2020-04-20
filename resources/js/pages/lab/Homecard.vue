<template>
<div id="app" v-if="curlab">
    <v-content>
        <div id="flex-container">
            <v-row>

                <v-hover v-slot:default="{ hover }" open-delay="200">
                    <v-row>
                        <v-col>
                            <v-card :elevation="hover ? 16 : 2" max-width="650" class="mx-auto">
                                <v-row>
                                    <v-icon large color="#00A8C9" class="ml-6 mx-2">whatshot</v-icon>
                                    <v-card-title style="font-family:Prompt;">อุปกรณ์ที่ถูกยืมบ่อย</v-card-title>
                                    <v-spacer></v-spacer>
                                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{
                                                    curlab.course_name
                                                }}</v-card-subtitle>
                                </v-row>
                                <div id="chart">
                                    <apexchart type="bar" height="350" width="650" :options="chartOptions" :series="total_qty_series"></apexchart>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-hover>

                <!-- <div id="chart"> -->
                <v-hover v-slot:default="{ hover }" open-delay="200">
                    <v-row>
                        <v-col>
                            <v-card :elevation="hover ? 16 : 2" max-width="650" class="mx-auto">
                                <v-row>
                                    <v-icon large color="#00A981" class="ml-6 mx-2">donut_large</v-icon>
                                    <v-card-title style="font-family:Prompt;">สถานะคำขอยืมทั้งหมด</v-card-title>
                                    <v-spacer></v-spacer>
                                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{
                                                    curlab.course_name
                                                }}</v-card-subtitle>
                                </v-row>
                                <div id="chart">
                                    <apexchart type="donut" height="363" width="500" :options="chartOptions_donut" :series="series_donut"></apexchart>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-hover>
                <!-- </div> -->
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

        <v-row align="center">
            <v-card class="mt-6 mb-6 mx-auto" max-width="420">
                <v-row>
                    <v-icon large color="#7F7DD9" class="ml-6 mx-2">block</v-icon>
                    <v-card-title style="font-family:Prompt;">อุปกรณ์ที่ถูกยืมบ่อย</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                </v-row>
                <v-card-text class="pt-0">
                    <v-data-table :headers="headers_frequency" :items="get_freqencylend" :items-per-page="5" class="elevation-1"><template #item.equip_id="{item}">{{
                                    getEquipCode(item.equipment_id)
                                }}</template>
                        <template #item.equipment_name="{item}">{{
                                    getEquipName(item.equipment_id)
                                }}</template></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light">สามารถตรวจสอบและเรียกดูอุปกรณ์ทั้งหมดได้ที่หน้าอุปกรณ์</span>
                </v-card-text>
            </v-card>
            <v-card class="mt-6 mb-6 mx-auto" max-width="420">
                <v-row>
                    <v-icon large color="#7F7DD9" class="ml-6 mx-2">block</v-icon>
                    <v-card-title style="font-family:Prompt;">สถิติการยืม</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                </v-row>
                <v-card-text class="pt-0">
                    <v-data-table :headers="headers_status" :items="get_detail" :items-per-page="5" class="elevation-1"></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light">สามารถตรวจสอบและเรียกดูอุปกรณ์ทั้งหมดได้ที่หน้าอุปกรณ์</span>
                </v-card-text>
            </v-card>

        </v-row>

        <v-row>
            <v-card class="mt-6 mb-6 mx-auto" max-width="420">
                <v-row>
                    <v-icon large color="#7F7DD9" class="ml-6 mx-2">block</v-icon>
                    <v-card-title style="font-family:Prompt;">อุปกรณ์ที่หมดสต็อก</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-subtitle class="mt-1 mr-4" style="font-size:16px;">{{ curlab.course_name }}</v-card-subtitle>
                </v-row>
                <v-card-text class="pt-0">
                    <v-data-table :headers="headers_outstock" :items="get_outstock" :items-per-page="5" class="elevation-1"></v-data-table>
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
                    <v-data-table :headers="headers_missing" :items="get_missinglists" :items-per-page="5" class="elevation-1">
                        <template #item.equip_id="{item}">{{
                                    getEquipCode(item.equipment_id)
                                }}</template>
                        <template #item.equipment_name="{item}">{{
                                    getEquipName(item.equipment_id)
                                }}</template>
                    </v-data-table>
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
                    <v-data-table :headers="headers_broken" :items="get_brokenlists" :items-per-page="5" class="elevation-1">
                        <template #item.equip_id="{item}">{{
                                    getEquipCode(item.equipment_id)
                                }}</template>
                        <template #item.equipment_name="{item}">{{
                                    getEquipName(item.equipment_id)
                                }}</template></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light">สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span>
                </v-card-text>
            </v-card>
        </v-row>

    </v-content>
</div>
</template>

<script>
export default {
    // props: ["course_id"],
    data: () => ({
        total_qty_series: [],
        freqlen_name: [],
        headers_status: [{
                text: "Status",
                align: "start",
                value: "status"
            },
            {
                text: "Count",
                value: "count"
            }
        ],
        headers_outstock: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equip_name"
            }
        ],
        headers_frequency: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equipment_name"
            },
            {
                text: "QTY",
                value: "len_qty"
            }
        ],
        headers_broken: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equipment_name"
            },
            {
                text: "QTY",
                value: "len_qty"
            }
        ],
        headers_missing: [{
                text: "Equipment ID",
                align: "start",
                value: "equip_id"
            },
            {
                text: "Equipment Name",
                value: "equipment_name"
            },
            {
                text: "QTY",
                value: "len_qty"
            }
        ],
        series_donut: [],
        chartOptions_donut: {
            chart: {
                type: "donut"
            },
            labels: [
                "Returned",
                "Recieved",
                "Ready",
                "Wait",
                "Broken",
                "Missing"
            ],
            responsive: [{
                breakpoint: 675,
                options: {
                    chart: {
                        width: 350
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }],
            colors: [
                "#018ffb",
                "#785ed0",
                "#01e396",
                "#546E7A",
                "#ff4661",
                "#feb01a"
            ]
        },
        total_qty_series: [],
        chartOptions: {
            chart: {
                width: "100%",
                height: 380,
                type: "bar",

            },
            plotOptions: {
                bar: {
                    barHeight: "100%",
                    distributed: true,
                    horizontal: true,
                    dataLabels: {
                        position: "bottom"
                    }
                }
            },
            colors: [
                "#33b2df",
                "#546E7A",
                "#d4526e",
                "#13d8aa",
                "#A5978B",
                "#2b908f",
                "#f9a3a4",
                "#90ee7e",
                "#f48024",
                "#69d2e7"
            ],
            dataLabels: {
                enabled: false,
                textAnchor: "start",
                style: {
                    colors: ["#fff"]
                },
                formatter: function (val, opt) {
                    return (
                        opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                    );
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },
            stroke: {
                width: 1,
                colors: ["#fff"]
            },
            xaxis: {},
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
                theme: "dark",
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function () {
                            return "";
                        }
                    }
                }
            },
            legend: {
                position: "right",
                verticalAlign: "top",
                containerMargin: {
                    left: 35,
                    right: 60
                }
            },
            responsive: [{
                breakpoint: 675,
                options: {
                    chart: {
                        width: 400
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }],
        }
    }),

    mounted() {
        this.$store.dispatch("loadEquipments");
        this.$store.dispatch("loadRequest_lists");
        this.$store.dispatch("loadRequest_details");
    },
    computed: {
        equipments() {
            return this.$store.state.equipments;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        request_lists() {
            return this.$store.state.request_lists;
        },
        request_details() {
            return this.$store.state.request_details;
        },
        equipmentsinlab() {
            let selequips =
                this.equipments.filter(
                    equipment => equipment.lab_id == this.curlab.id
                ) || {};
            return selequips;
        },
        Requestlistsinlab() {
            let selrequestlist =
                this.request_lists.filter(
                    request_list => request_list.lab_id == this.curlab.id
                ) || {};
            return selrequestlist;
        },
        get_missinglists() {
            const result = this.request_details.filter(({
                equipment_id
            }) => this.equipmentsinlab.some(x => x.id == equipment_id))

            let missinglists =
                result.filter(
                    reqdetail => reqdetail.status == "missing"
                ) || {};

            var temp = [];

            var produce = [];

            for (var i = 0; i < missinglists.length; i++) {
                if (temp.indexOf(missinglists[i].equipment_id) == -1) {
                    temp.push(missinglists[i].equipment_id);
                    var _data = {};
                    _data.equipment_id = missinglists[i].equipment_id;
                    // _data.len_qty = missinglists[i].len_qty;
                    _data.len_qty = 1;

                    produce.push(_data);
                } else {
                    for (var j = 0; j < produce.length; j++) {
                        if (
                            produce[j].equipment_id ===
                            missinglists[i].equipment_id
                        ) {
                            var _x = parseInt(produce[j].len_qty) + 1;
                            produce[j].len_qty = _x;
                        }
                    }
                }
            }
            return produce;
        },
        get_brokenlists() {
            const result = this.request_details.filter(({
                equipment_id
            }) => this.equipmentsinlab.some(x => x.id == equipment_id))

            let brokenlists =
                result.filter(
                    req_detail =>
                    req_detail.status == "broken"
                ) || {};
            var temp = [];

            var produce = [];

            for (var i = 0; i < brokenlists.length; i++) {
                if (temp.indexOf(brokenlists[i].equipment_id) == -1) {
                    temp.push(brokenlists[i].equipment_id);
                    var _data = {};
                    _data.equipment_id = brokenlists[i].equipment_id;
                    // _data.len_qty = brokenlists[i].len_qty;
                    _data.len_qty = 1;

                    produce.push(_data);
                } else {
                    for (var j = 0; j < produce.length; j++) {
                        if (
                            produce[j].equipment_id ===
                            brokenlists[i].equipment_id
                        ) {
                            var _x = parseInt(produce[j].len_qty) + 1;
                            produce[j].len_qty = _x;
                        }
                    }
                }
            }
            return produce;
        },
        get_freqencylend() {
            const result = this.request_details.filter(({
                equipment_id
            }) => this.equipmentsinlab.some(x => x.id == equipment_id))

            let returnlists =
                result.filter(
                    req_detail =>
                    req_detail.status == "return"
                ) || {};

            var temp = [];

            var produce = [];

            for (var i = 0; i < returnlists.length; i++) {
                if (temp.indexOf(returnlists[i].equipment_id) == -1) {
                    temp.push(returnlists[i].equipment_id);
                    var _data = {};
                    _data.equipment_id = returnlists[i].equipment_id;
                    _data.len_qty = returnlists[i].len_qty;

                    produce.push(_data);
                } else {
                    for (var j = 0; j < produce.length; j++) {
                        if (
                            produce[j].equipment_id ===
                            returnlists[i].equipment_id
                        ) {
                            var _x =
                                parseInt(produce[j].len_qty) +
                                parseInt(returnlists[i].len_qty);
                            produce[j].len_qty = _x;
                        }
                    }
                }
            }
            produce.sort((a, b) => parseInt(b.len_qty) - parseInt(a.len_qty));

            var _name = [];
            for (var k = 0; k < produce.length; k++) {
                let getname = this.getEquipName(produce[k].equipment_id);
                _name.push(getname);
            }
            var _fullname = {};
            _fullname.categories = _name;
            this.chartOptions.xaxis = _fullname;

            var _total = [];
            for (var l = 0; l < produce.length; l++) {
                _total.push(parseInt(produce[l].len_qty));
            }
            var _fulltotal = {};
            _fulltotal.data = _total;
            var _fulltotalarr = [];
            _fulltotalarr.push(_fulltotal);
            this.total_qty_series = _fulltotalarr;

            return produce;
        },
        get_outstock() {
            let outstocklists =
                this.equipmentsinlab.filter(eq => eq.equip_qty == 0) || {};
            return outstocklists;
        },
        get_detail() {
            var temp = [];

            var produce = [];

            for (var i = 0; i < this.Requestlistsinlab.length; i++) {
                if (temp.indexOf(this.Requestlistsinlab[i].status) == -1) {
                    temp.push(this.Requestlistsinlab[i].status);
                    var _data = {};
                    _data.status = this.Requestlistsinlab[i].status;
                    _data.count = 1;

                    produce.push(_data);
                } else {
                    for (var j = 0; j < produce.length; j++) {
                        if (
                            produce[j].status ===
                            this.Requestlistsinlab[i].status
                        ) {
                            var _x = parseInt(produce[j].count) + 1;
                            produce[j].count = _x;
                        }
                    }
                }
            }
            produce.sort((a, b) => parseInt(b.count) - parseInt(a.count));

            var _status = [];
            for (var k = 0; k < produce.length; k++) {
                _status.push(produce[k].status);
            }
            this.chartOptions_donut.labels = _status;

            var _total = [];
            for (var l = 0; l < produce.length; l++) {
                _total.push(parseInt(produce[l].count));
            }
            this.series_donut = _total;

            // console.log(produce);
            return produce;
        }
    },
    methods: {
        getEquipName(equipId) {
            // console.log(equipId);
            let equipname =
                this.equipments.find(equip => equip.id == equipId) || {};
            // console.log(equipname.equip_name);
            return equipname.equip_name;
        },
        getEquipCode(equipId) {
            let equipname =
                this.equipments.find(equip => equip.id == equipId) || {};
            return equipname.equip_id;
        }
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

#chart {
    max-width: 650px;
    margin: 35px auto;
}
</style>
