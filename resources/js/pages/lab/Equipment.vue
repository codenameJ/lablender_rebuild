<template>
<v-content>
    <v-container class="my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <v-toolbar>
                    <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                </v-toolbar>
            </div>
            <div class="col-md-12">
                <v-data-table :headers="headers" :items="filterEquipments" class="elevation-1" :sort-by.sync="sortBy">
                    <template v-slot:top>
                        <v-toolbar flat color="white">
                            <v-toolbar-title>Equipment</v-toolbar-title>
                            <v-divider class="mx-4" inset vertical></v-divider>
                            <v-spacer></v-spacer>
                            <v-dialog v-model="dialog" max-width="800px">
                                <template v-slot:activator="{ on }">
                                    <v-btn class="white--text" color="primary" outlined v-on="on">
                                        <v-icon class="mr-2">add</v-icon>Add Equipment
                                    </v-btn>
                                </template>
                                <v-spacer></v-spacer>
                                <v-card>
                                    <v-card-title>
                                        <span class="headline">{{
                                                formTitle
                                            }}</span>
                                    </v-card-title>

                                    <v-card-text>
                                        <v-container>
                                            <v-row class="mr-5 ml-5">
                                                <v-img class="mx-auto" style="width: 30%;
                                                                        max-width: 240px;
                                                                        height: auto;" v-if="
                                                                editedItem.picture_path
                                                            " :src="
                                                            ('/storage/') +
                                                                    editedItem.picture_path
                                                            " />
                                            </v-row>
                                            <v-row>
                                                <input class="my-4 mx-auto" id="uploadImage" type="file" @change="onImageChange" />

                                                <center>
                                                    <img :src="editedItem.image" v-if="editedItem.image" class="img-responsive" height="100px" />
                                                </center>
                                            </v-row>
                                            <v-row>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="
                                                                editedItem.equip_id
                                                            " label="ID"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="
                                                                editedItem.equip_name
                                                            " label="Name"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="
                                                                editedItem.equip_qty
                                                            " label="QTY"></v-text-field>
                                                </v-col>
                                            </v-row>
                                            <v-row>
                                                <v-col cols="12">
                                                    <v-textarea v-model="
                                                                editedItem.description
                                                            " label="Description"></v-textarea>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="grey darken-2" text @click="close">Cancel</v-btn>
                                        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-toolbar>
                    </template>
                    <template v-slot:item.action="{ item }">
                        <v-icon small class="mr-2" @click="editItem(item)">
                            edit
                        </v-icon>
                        <v-icon small @click="deleteItem(item)">
                            delete
                        </v-icon>
                    </template>
                </v-data-table>
            </div>
        </div>
    </v-container>
</v-content>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadEquipments");
        this.seteditlab();
        this.setdefaultlab();
    },
    data: () => ({
        dialog: false,
        sortBy: "equip_id",
        search: "",
        today: new Date(),
        headers: [
            // { text: "ID", value: "id" },
            {
                text: "Equip ID",
                value: "equip_id"
            },
            {
                text: "Equip Name",
                align: "left",
                sortable: false,
                value: "equip_name"
            },
            {
                text: "Qty",
                value: "equip_qty"
            },
            {
                text: "Lab",
                value: "lab_id"
            },
            {
                text: "Actions",
                value: "action",
                sortable: false
            }
        ],
        editedIndex: -1,
        editedItem: {
            equip_id: "",
            equip_name: "",
            equip_qty: 0,
            lab_id: "",
            description: "",
            picture_path: null,
            image: null
        },
        defaultItem: {
            equip_id: "",
            equip_name: "",
            equip_qty: 0,
            lab_id: "",
            description: "",
            picture_path: null,
            image: null
        }
    }),
    created() {},
    methods: {
        seteditlab() {
            this.editedItem.lab_id = this.curlab.id;
            return this.editedItem.lab_id;
        },
        setdefaultlab() {
            this.defaultItem.lab_id = this.curlab.id;
            return this.defaultItem.lab_id;
        },
        editItem(item) {
            this.editedIndex = this.equipments.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
            this.$store.dispatch("loadEquipments");
        },
        deleteItem(item) {
            const index = this.equipments.indexOf(item);
            if (
                confirm("Are you sure you want to delete this item?") &&
                this.equipments.splice(index, 1)
            ) {
                axios
                    .delete("/api/equipment/" + item.id)
                    .then(response => console.log(response.data));

                this.$store.dispatch("loadEquipments");
            }
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
                Object.assign(
                    this.equipments[this.editedIndex],
                    this.editedItem
                );
                axios
                    .put(
                        "/api/equipment/" + this.editedItem.id,
                        this.editedItem
                    )
                    .then(response => console.log(response.data));
            } else {
                this.equipments.push(this.editedItem);
                axios
                    .post("/api/equipment/", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
            this.$store.dispatch("loadEquipments");
        },
        onImageChange(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            this.noUpload = false;
            reader.onloadend = e => {
                this.editedItem.image = reader.result;
                var date =
                    this.today.getFullYear() +
                    "-" +
                    (this.today.getMonth() + 1) +
                    "-" +
                    this.today.getDate();
                var time =
                    this.today.getHours() + "-" + this.today.getMinutes();
                var x = Math.floor(Math.random() * 100);
                var dateTime = date + "_" + time;
                const file_name = "image_" + dateTime + "_" + x + ".png";
                this.editedItem.picture_path = file_name;
            };
            reader.readAsDataURL(file);
        }
    },
    computed: {
        equipments() {
            return this.$store.state.equipments;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        equipmentsinlab() {
            let selequips =
                this.equipments.filter(
                    equipment => equipment.lab_id == this.curlab.id
                ) || {};
            return selequips;
        },
        filterEquipments: function () {
            return this.equipmentsinlab.filter(equip => {
                return equip.equip_name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        formTitle() {
            return this.editedIndex === -1 ? "New Equipment" : "Edit Equipment";
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        }
    }
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
