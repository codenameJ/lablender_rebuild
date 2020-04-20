<template>
    <v-row>
        <v-col cols="12">
            <div v-if="filterDetails.length == 0">
                <v-row>
                    <v-img
                        class="mx-auto my-4"
                        style="max-width: 13%;height: auto;"
                        src="/img/happy.png"
                    ></v-img>
                </v-row>
                <v-row>
                    <span class="mx-auto mb-1 title"
                        >No missing equipments found.</span
                    >
                </v-row>
                <v-row>
                    <span
                        style="font-family:Prompt;"
                        class="mx-auto subheading grey--text"
                        >ยังไม่มีอุปกรณ์ที่สูญหายในห้องปฏิบัติการนี้</span
                    >
                </v-row>
            </div>
            <div v-for="(item, i) in filterReceive" :key="i">
                <v-card class="mb-5" v-if="item.request_detail.length != 0">
                    <v-row>
                        <v-card-title
                            class="ml-4"
                            v-text="'Request No. ' + item.id"
                        ></v-card-title>
                        <v-spacer></v-spacer>
                        <v-card-actions class=" mr-5">
                            <v-btn
                                v-if="item.status == 'wait'"
                                color="error"
                                fab
                                x-small
                                dark
                                outlined
                                class="elevation-4 no-underline"
                                @click="deleteItem(item)"
                            >
                                <v-icon>delete_outline</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-row>

                    <!-- --------------------------------------------------------------------- -->
                    <v-row>
                        <v-card-subtitle
                            class="ml-4"
                            v-text="'Lending date : ' + item.created_at"
                        ></v-card-subtitle>
                    </v-row>

                    <v-row>
                        <v-card-subtitle
                            class="ml-4"
                            v-text="'Lend by : ' + getstudent(item.student_id)"
                        ></v-card-subtitle>
                    </v-row>

                    <v-row>
                        <v-card-subtitle
                            class="ml-4"
                            v-text="'Status : '"
                        ></v-card-subtitle>
                        <v-chip :color="getColor(item.status)" dark>{{
                            item.status
                        }}</v-chip>
                    </v-row>
                    <div class="col-12">
                        <v-data-table
                            class="mt-2"
                            :headers="detail_headers"
                            :items="item.request_detail"
                            hide-default-footer
                        >
                            <template #item.equipment_name="{item}">{{
                                getEquipName(item.equipment_id)
                            }}</template>
                        </v-data-table>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-dialog
                                v-model="returndialog"
                                max-width="500px"
                                :retain-focus="false"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        outlined
                                        color="blue darken-1"
                                        v-on="on"
                                        @click="setDetail(item)"
                                        >Return</v-btn
                                    >
                                </template>
                                <v-card>
                                    <v-card-title>
                                        <span class="headline"
                                            >Return Item</span
                                        >
                                    </v-card-title>
                                    <v-card-text>
                                        <v-container>
                                            <v-data-table
                                                class="mt-2"
                                                :headers="vcard_detail_header"
                                                :items="selectedDetails"
                                                hide-default-footer
                                            >
                                                <template
                                                    #item.equip_id="{item}"
                                                    >{{
                                                        getEquipCode(
                                                            item.equipment_id
                                                        )
                                                    }}</template
                                                >
                                                <template
                                                    #item.equipment_name="{item}"
                                                    >{{
                                                        getEquipName(
                                                            item.equipment_id
                                                        )
                                                    }}</template
                                                >
                                                <template #item.status="{item}">
                                                    <v-select
                                                        v-model="item.status"
                                                        :items="ckecklist"
                                                    >
                                                    </v-select>
                                                </template>
                                            </v-data-table>
                                            <v-card-actions>
                                                <v-btn
                                                    outlined
                                                    color="blue darken-1"
                                                    @click="save(getrequestid)"
                                                    >Save</v-btn
                                                >
                                            </v-card-actions>
                                        </v-container>
                                    </v-card-text>
                                </v-card>
                            </v-dialog>
                        </v-card-actions>
                    </div>
                </v-card>
            </div>
        </v-col>
    </v-row>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadMissing_lists");
        this.$store.dispatch("loadRequest_details");
         this.$store.dispatch("loadStudents");
        this.$store.dispatch("loadEquipments");
    },
    data: () => ({
        returndialog: false,
        checkselect: null,
        ckecklist: [
            {
                value: 2,
                text: "return"
            },
            {
                value: 3,
                text: "broken"
            },
            {
                value: 4,
                text: "missing"
            }
        ],
        detail_headers: [
            // {
            //     text: "Detail ID",
            //     value: "id"
            // },
            {
                text: "Equipment ID",
                value: "equipment_id"
            },
            {
                text: "Equipment Name",
                value: "equipment_name"
            },
            {
                text: "Len Qty",
                value: "len_qty"
            }
        ],
        vcard_detail_header: [
            // {
            //     text: "Detail ID",
            //     value: "id"
            // },
            {
                text: "Equipment ID",
                value: "equipment_id"
            },
            {
                text: "Equipment Name",
                value: "equipment_name"
            },
            {
                text: "Len Qty",
                value: "len_qty"
            },
            {
                text: "status",
                value: "status"
            }
        ],
        editedIndex: -1,
        editedItem: [],
        selectedDetails: [],
        getrequestid: null,
        status: "return"
    }),
    created() {},
    methods: {
        getColor(status) {
            if (status == "wait") return "blue-grey";
            else if (status == "ready") return "green";
            else if (status == "broken") return "red";
            else if (status == "missing") return "orange accent-2";
            else if (status == "returned") return "#1a73e8";
            else return "#CE93D8";
        },
        getstudent(stdid) {
            let thisuser =
                this.users.find(user => {
                    return user.student;
                }) || {};
            return thisuser.name;
        },
        getEquipName(equipId) {
            let equipname =
                this.equipments.find(equip => equip.id == equipId) || {};
            return equipname.equip_name;
        },
        getEquipCode(equipId) {
            let equipname =
                this.equipments.find(equip => equip.id == equipId) || {};
            return equipname.equip_id;
        },
        deleteItem(item) {
            const index = this.missing_lists.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.missing_lists.splice(index, 1);

            axios
                .delete("/api/requestlist/" + item.id)
                .then(response => console.log(response.data));

            this.$store.dispatch("loadMissing_lists");
            this.$store.dispatch("loadRequest_details");
        },
        save(missing_list_id) {
            console.log(missing_list_id);
            axios
                .put("/api/requestlist/" + missing_list_id, {
                    status: this.status,
                    cmd: "return",
                    selectedDetails: this.selectedDetails
                })
                .then(response => console.log(response.data));
            this.returndialog = false;
            this.$store.dispatch("loadMissing_lists");
            this.$store.dispatch("loadRequest_details");
        },
        setDetail(item) {
            this.getrequestid = item.id;
            this.selectedDetails = item.request_detail;
            console.log(this.selectedDetails);
        }
        // show(arrayData) {
        //     return arrayData.filter(data => data.status == "missing");
        // }
    },
    computed: {
        equipments() {
            return this.$store.state.equipments;
        },
        users() {
            return this.$store.state.users;
        },
        missing_lists() {
            return this.$store.state.missing_lists;
        },
        request_details() {
            return this.$store.state.request_details;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        Requestlistsinlab() {
            let selrequestlist =
                this.missing_lists.filter(
                    missing_list => missing_list.lab_id == this.curlab.id
                ) || {};
            return selrequestlist;
        },
        filterReceive() {
            let readylist =
                this.Requestlistsinlab.filter(
                    list => list.status == "return"
                ) || {};
            return readylist;
        },
        filterDetails() {
            let detail =
                this.request_details.filter(item => item.status == "missing") ||
                {};
            return detail;
        }
    },
    watch: {}
};
</script>

<style scoped>
.btn-gradient {
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}

.blackhref {
    text-decoration: none;
    color: #000000;
}

.whitehref {
    text-decoration: none;
    color: #ffffff;
}

.no-underline {
    text-decoration: none;
}
</style>
