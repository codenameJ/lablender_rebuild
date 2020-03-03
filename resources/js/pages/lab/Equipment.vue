<template>
    <div id="app" v-if="curlab">
        <v-content>
            <v-data-table
                :headers="headers"
                :items="equips"
                class="elevation-1 txt-title"
            >
                <template v-slot:top>
                    <v-toolbar flat color="white">
                        <v-toolbar-title>Equipments {{curlab.course_id}} </v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <v-dialog v-model="dialog" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    color="primary"
                                    dark
                                    class="mb-2"
                                    v-on="on"
                                    >Add Equipment</v-btn
                                >
                            </template>
                            <v-card>
                                <v-card-title>
                                    <!-- <span class="headline">{{
                                        formTitle
                                    }}</span> -->
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.Equip_id
                                                    "
                                                    label="Equipment ID"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.Equip_Name
                                                    "
                                                    label="Equipment Name"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.Equip_Num
                                                    "
                                                    label="QTY"
                                                ></v-text-field>
                                            </v-col>
                                            <!-- <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="editedItem.Lab_id"
                                                    label="Lab ID"
                                                ></v-text-field>
                                            </v-col> -->

                                            <v-col cols="12" sm="6" md="4">
                                                <v-select
                                                    v-model="editedItem.Lab_id"
                                                    :items="labs"
                                                    label="Lab ID"
                                                    item-text="Lab_id"
                                                ></v-select>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="blue darken-1"
                                        text
                                        @click="close"
                                        >Cancel</v-btn
                                    >
                                    <v-btn
                                        color="blue darken-1"
                                        text
                                        @click="save"
                                        >Save</v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:item.action="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                        edit
                    </v-icon>
                    <v-icon small @click="deleteItem(item.id, item)">
                        delete
                    </v-icon>
                </template>
                <template v-slot:no-data>
                    <!-- <v-btn color="primary" @click="getEquipData">Reset</v-btn> -->
                </template>
            </v-data-table>
        </v-content>
    </div>
</template>

<script>
export default {
    mounted() {
        // this.getEquipData();
        // this.getLabData();
    },
    data: () => ({
        // return {
        dialog: false,
        search: "",
        headers: [
            // { text: "ID", value: "id" },
            { text: "Equip ID", value: "Equip_id" },
            {
                text: "Equip Name",
                align: "left",
                sortable: false,
                value: "Equip_Name"
            },
            { text: "Qty", value: "Equip_Num" },
            { text: "Lab", value: "Lab_id" },
            // { text: "created at", value: "created_at" },
            // { text: "updated at", value: "updated_at" },
            { text: "Actions", value: "action", sortable: false }
        ],
        equips: [],
        editedIndex: -1,
        editedItem: {
            Equip_id: 0,
            Equip_Name: "",
            Equip_Num: 0,
            Lab_id: 0
        },
        defaultItem: {
            Equip_id: 0,
            Equip_Name: "",
            Equip_Num: 0,
            Lab_id: 0
        },
        labs: []
        // },
    }),

    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {
        // this.getEquipData();
    },

    methods: {
        // getEquipData() {
        //     axios.get("api/equipment").then(Response => {
        //         this.equips = Response.data;
        //         console.log(this.equips);
        //     });
        // },

        // getLabData() {
        //     axios.get("api/lab").then(Response => {
        //         this.labs = Response.data;
        //         console.log(this.labs);
        //     });
        // },

        editItem(item) {
            this.editedIndex = this.equips.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(id, item) {
            const index = this.equips.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.equips.splice(index, 1);

            axios
                .delete("api/equipment/" + item.id)
                .then(response => console.log(response.data));
        },

        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.equips[this.editedIndex], this.editedItem);
                axios
                    .put("api/equipment/" + this.editedItem.id, this.editedItem)
                    .then(response => console.log(response.data));
            } else {
                this.equips.push(this.editedItem);
                axios
                    .post("api/equipment", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
            location.reload();
        }
    }
};
</script>
