<template>
    <div id="app">
        <v-content>
            <v-container class="my-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <v-card>
                            <v-data-table
                                :headers="headers"
                                :items="filterEquipments"
                                class="elevation-1 txt-title"
                                :sort-by.sync="sortBy"
                            >
                                <template v-slot:top>
                                    <v-toolbar flat color="white">
                                        <v-toolbar-title
                                            >Equipments</v-toolbar-title
                                        >
                                        <v-spacer></v-spacer>

                                        <v-text-field
                                            v-model="search"
                                            append-icon="search"
                                            label="Search"
                                            single-line
                                            hide-details
                                        ></v-text-field>

                                        <v-dialog
                                            v-model="dialog"
                                            max-width="800px"
                                            :retain-focus="false"
                                        >
                                            <v-card>
                                                <v-card-title>
                                                    <span class="headline"
                                                        >Lend</span
                                                    >
                                                </v-card-title>

                                                <v-card-text>
                                                    <v-container>
                                                        <v-row class="mr-5 ml-5">
                                                        <img
                                                            class="mx-auto my-4"
                                                            style="width: 30%;
                                                                        max-width: 240px;
                                                                        height: auto;"
                                                            v-if="
                                                                editedItem.picture_path
                                                            "
                                                            :src="
                                                            ('/storage/') +
                                                                    editedItem.picture_path
                                                            "
                                                            height="200px"
                                                        />
                                                    </v-row>
                                                        <v-row
                                                            class="justify-content-center"
                                                        >
                                                            <v-col
                                                                cols="12"
                                                                sm="6"
                                                                md="4"
                                                            >
                                                                <v-text-field
                                                                    :value="
                                                                        editedItem.equip_id
                                                                    "
                                                                    label="Equipment ID"
                                                                    readonly
                                                                ></v-text-field>
                                                            </v-col>
                                                            <v-col
                                                                cols="12"
                                                                sm="6"
                                                                md="4"
                                                            >
                                                                <v-text-field
                                                                    :value="
                                                                        editedItem.equip_name
                                                                    "
                                                                    label="Equipment Name"
                                                                    readonly
                                                                ></v-text-field>
                                                            </v-col>
                                                        </v-row>
                                                        <v-row
                                                            class="justify-content-center"
                                                        >
                                                            <v-col
                                                                xl="8"
                                                                lg="8"
                                                                md="12"
                                                                sm="12"
                                                                xs="12"
                                                            >
                                                                <v-textarea
                                                                    v-model="
                                                                        editedItem.description
                                                                    "
                                                                    label="Description"
                                                                    readonly
                                                                    rows="2"
                                                                ></v-textarea>
                                                            </v-col>
                                                        </v-row>
                                                        <v-row
                                                            class="justify-content-center"
                                                        >
                                                            <v-col
                                                                cols="12"
                                                                sm="6"
                                                                md="4"
                                                            >
                                                                <!-- <v-input-number
                                                                    v-model="
                                                                        quantity
                                                                    "
                                                                    :rules="[
                                                                        rules.lower
                                                                    ]"
                                                                    :min="1"
                                                                    :max="
                                                                        editedItem.equip_qty
                                                                    "
                                                                    inline
                                                                    controls
                                                                >
                                                                </v-input-number> -->
                                                                <number-input 
                                                                v-model="quantity" 
                                                                :min="1" 
                                                                :max="editedItem.equip_qty" 
                                                                :inputtable="false" 
                                                                inline
                                                                controls
                                                                center>
                                                                </number-input>
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
                                                        @click="
                                                            addCart(editedItem)
                                                        "
                                                        >Lend</v-btn
                                                    >
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-toolbar>
                                </template>
                                <template v-slot:item.action="{ item }">
                                    <v-btn
                                        v-if="item.equip_qty > 0"
                                        small
                                        rounded
                                        outlined
                                        class="elevation-2"
                                        color="#1a73e8"
                                        @click="editItem(item)"
                                    >
                                        <v-icon small class="mr-2" left
                                            >add_circle_outline</v-icon
                                        >
                                        Lend
                                    </v-btn>
                                    <v-btn
                                        v-if="item.equip_qty <= 0"
                                        disabled
                                        small
                                        rounded
                                        outlined
                                        class="elevation-2"
                                        color="#1a73e8"
                                    >
                                        <v-icon small class="mr-2" left
                                            >add_circle_outline</v-icon
                                        >
                                        Lend
                                    </v-btn>
                                </template>
                            </v-data-table>
                        </v-card>
                    </div>
                </div>
            </v-container>
        </v-content>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadEquipments");
        this.seteditlab();
        this.setdefaultlab();
    },
    data: () => ({
        rules: {
            lower: value => value >= 1 || "Must lend more than 1 pc."
        },
        sortBy: "equip_id",
        dialog: false,
        dialogcart: false,
        search: "",
        headers: [
            { text: "Equip ID", value: "equip_id" },
            {
                text: "Equip Name",
                align: "left",
                sortable: false,
                value: "equip_name"
            },
            { text: "Qty", value: "equip_qty" },
            { text: "Actions", value: "action", sortable: false }
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
        },
        cartadd: {
            equip_id: 0,
            equip_name: "",
            amount: 0
        },
        badge: 0,
        quantity: 1
    }),

    computed: {
        currentuser() {
            return this.$store.state.selectedUser;
        },
        viewCart() {
            return this.$store.state.cart;
        },
        showBadge() {
            this.badge = this.viewCart.length;
            return this.badge;
        },
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
        filterEquipments: function() {
            return this.equipmentsinlab.filter(equip => {
                return equip.equip_name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

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
        addCart(equipment) {
            this.cartadd.id = equipment.id;
            this.cartadd.equip_id = equipment.equip_id;
            this.cartadd.equip_name = equipment.equip_name;
            this.cartadd.amount = this.quantity;
            this.$store.commit("addToCart", this.cartadd);
            this.cartadd = {};
            this.quantity = 1;
            this.close();
        },
        removeCart(index) {
            this.$store.commit("removeFromCart", index);
        },

        editItem(item) {
            this.editedIndex = this.equipments.indexOf(item);
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
        },
        closecart() {
            this.dialogcart = false;
        }
    }
};
</script>

<style scoped>
.button-btn-gradient {
    background-color: #0c0b0b;
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}
</style>
