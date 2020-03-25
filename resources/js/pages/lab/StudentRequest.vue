<template>
    <v-content>
        <v-container class="my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <v-row dense>
                        <v-col cols="12">
                            <v-toolbar>
                                <v-text-field
                                    v-model="search"
                                    append-icon="search"
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field>
                            </v-toolbar>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="12">
                            <div v-for="(item, i) in StudentRequest" :key="i">
                                <v-card class="mb-5">
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
                                            v-text="
                                                'Lending date : ' +
                                                    item.created_at
                                            "
                                        ></v-card-subtitle>
                                    </v-row>

                                    <v-row>
                                        <v-card-subtitle
                                            class="ml-4"
                                            v-text="
                                                'Lend by : ' + currentuser.name
                                            "
                                        ></v-card-subtitle>
                                    </v-row>

                                    <v-row>
                                        <v-card-subtitle
                                            class="ml-4"
                                            v-text="'Status : '"
                                        ></v-card-subtitle>
                                        <v-chip
                                            :color="getColor(item.status)"
                                            dark
                                            >{{ item.status }}</v-chip
                                        >
                                    </v-row>
                                    <!-- <v-data-table
                                        :headers="detail_headers"
                                        :items="item.request_detail"
                                        hide-default-footer
                                    >
                                    </v-data-table> -->
                                    <!-- <table class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width:25%">
                                                    Equipment Name
                                                </th>
                                                <th style="width:25%">
                                                    Lend QTY
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(equip,
                                                i) in item.request_detail"
                                                :key="i"
                                            >
                                                <td>
                                                    {{
                                                        getEquipName(
                                                            equip.equipment_id
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{ equip.len_qty }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                    <div class="col-12">
                                    <v-data-table
                                        class="mt-2"
                                        :headers="detail_headers"
                                        :items="item.request_detail"
                                        hide-default-footer
                                    >
                                    <template #item.equipment_name="{item}">{{getEquipName(item.equipment_id)}}</template>
                                    </v-data-table>
                                    </div>
                                </v-card>
                            </div>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-container>
    </v-content>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadRequest_lists");
    },
    data: () => ({
        dialog: false,
        search: "",
        detail_headers: [
            { text: "Detail ID", value: "id" },
            { text: "Equipment ID", value: "equipment_id" },
            { text: "Equipment Name", value: "equipment_name"},
            { text: "Len Qty", value: "len_qty" }
        ],
        editedIndex: -1,
        editedItem: {
            equip_id: "",
            equip_name: "",
            equip_qty: 0,
            lab_id: ""
        },
        defaultItem: {
            equip_id: "",
            equip_name: "",
            equip_qty: 0,
            lab_id: ""
        }
    }),
    created() {},
    methods: {
        getColor (status) {
        if (status == "wait") return 'blue-grey'
        else if (status == "ready") return 'green'
        else if (status == "broken") return 'red'
        else if (status == "missing") return 'orange accent-2'
        else if (status == "returned") return '#1a73e8'
        else return '#CE93D8'
      },
        getEquipName(equipId) {
            let equipname =
                this.equipments.find(equip => equip.id == equipId) || {};
            return equipname.equip_name;
        },
        deleteItem(item) {
            const index = this.request_lists.indexOf(item);
            if (
                confirm("Are you sure you want to delete this item?") &&
                this.request_lists.splice(index, 1)
            ) {
                axios
                    .delete("/api/requestlist/" + item.id)
                    .then(response => console.log(response.data));

                this.$store.dispatch("loadRequest_lists");
            }
        }
    },
    computed: {
        equipments() {
            return this.$store.state.equipments;
        },
        currentuser() {
            return this.$store.state.selectedUser;
        },
        request_lists() {
            return this.$store.state.request_lists;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        Requestlistsinlab() {
            let selrequestlist =
                this.request_lists.filter(
                    request_list => request_list.lab_id == this.curlab.id
                ) || {};
            return selrequestlist;
        },
        StudentRequest() {
            let studentreqlist =
                this.Requestlistsinlab.filter(
                    stdreq => stdreq.student_id == this.currentuser.student.id
                ) || {};
            return studentreqlist;
        },
        filterRequestlists: function() {
            return this.StudentRequest.filter(requestlist => {
                return requestlist.student_id
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
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
