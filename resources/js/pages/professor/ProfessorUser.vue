<template>
    <v-container class="my-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <v-toolbar
                    ><v-tabs background-color="transparent" v-model="tabs">
                        <v-tab style="text-decoration : none;" to="">All</v-tab>
                        <v-tab style="text-decoration : none;">Students</v-tab>
                        <v-tab style="text-decoration : none;" to=""
                            >Professor</v-tab
                        >
                        <v-tabs-slider color="white"></v-tabs-slider>
                    </v-tabs>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-toolbar>
            </div>
            <div class="col-md-9">
                <v-data-table
                    :headers="headers"
                    :items="filterUser"
                    class="elevation-1"
                >
                    <template v-slot:top>
                        <v-toolbar flat color="white">
                            <v-toolbar-title>User</v-toolbar-title>
                            <v-divider class="mx-4" inset vertical></v-divider>
                            <v-spacer></v-spacer>
                            <v-dialog v-model="dialog" max-width="500px">
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="primary"
                                        dark
                                        class="mb-2"
                                        v-on="on"
                                        >Add User</v-btn
                                    >
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
                                            <v-row>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.name
                                                        "
                                                        label="Name"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.email
                                                        "
                                                        :rules="emailRules"
                                                        label="E-mail"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.password
                                                        "
                                                        label="Password"
                                                        :type="
                                                            value
                                                                ? 'password'
                                                                : 'text'
                                                        "
                                                        :append-icon="
                                                            value
                                                                ? 'visibility'
                                                                : 'visibility_off'
                                                        "
                                                        @click:append="
                                                            () =>
                                                                (value = !value)
                                                        "
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                            <v-row>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.phone
                                                        "
                                                        :counter="10"
                                                        :rules="phoneRules"
                                                        label="phone"
                                                        type="number"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-select
                                                        v-model="
                                                            editedItem.type
                                                        "
                                                        :items="selecttype"
                                                        label="Type"
                                                        item-text="name"
                                                        return-object
                                                        chips
                                                    ></v-select>
                                                </v-col>
                                                <!-- <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-if="
                                                            editedItem.type ==
                                                                'ta'
                                                        "
                                                        v-model="editedItem.lab_id"
                                                        label="Lab ID"
                                                    ></v-text-field> -->

                                                <v-col cols="12" sm="6" md="4">
                                                    <v-select
                                                        v-if="
                                                            editedItem.type ==
                                                                'ta'
                                                        "
                                                        v-model="
                                                            editedItem.lab_id
                                                        "
                                                        :items="labs"
                                                        label="Lab ID"
                                                        item-text="course_id"
                                                    ></v-select>

                                                    <v-text-field
                                                        v-if="
                                                            editedItem.type ==
                                                                'student'
                                                        "
                                                        v-model="
                                                            editedItem.student_id
                                                        "
                                                        label="Student ID"
                                                    ></v-text-field>
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
                        <v-icon small @click="deleteItem(item)">
                            delete
                        </v-icon>
                    </template>
                </v-data-table>
            </div>
        </div>
    </v-container>
</template>

<script>
export default {
    mounted() {
        // this.getLabData();
        // this.$store.dispatch("loadLabs");
    },
    data: () => ({
        filtertab: null,
        dialog: false,
        search: "",
        tabs: null,
        valid: true,
        value: String,
        emailRules: [
            v => !!v || "E-mail is required",
            v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        ],
        phoneRules: [
            v => !!v || "Phone number is required.",
            v => (v && v.length <= 10) || "Phone number must be valid"
        ],
        selecttype: ["student", "professor", "ta", "admin"],
        headers: [
            { text: "ID", value: "id" },
            { text: "Name", value: "name" },
            {
                text: "E-mail",
                align: "left",
                sortable: false,
                value: "email"
            },
            { text: "Phone", value: "phone" },
            { text: "Type", value: "type" },
            { text: "Actions", value: "action", sortable: false }
        ],
        editedIndex: -1,
        editedItem: {
            name: "",
            email: "",
            password: "",
            phone: "",
            type: "",
            student_id: "",
            lab_id: ""
        },
        defaultItem: {
            name: "",
            email: "",
            password: "",
            phone: "",
            type: "",
            student_id: "",
            lab_id: ""
        }
    }),
    created() {},
    methods: {
        editItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
            this.$store.dispatch("loadUsers");
        },
        deleteItem(item) {
            const index = this.users.indexOf(item);
            if (
                confirm("Are you sure you want to delete this item?") &&
                this.users.splice(index, 1)
            ) {
                axios
                    .delete("/api/user/" + item.id)
                    .then(response => console.log(response.data));

                this.$store.dispatch("loadUsers");
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
                Object.assign(this.users[this.editedIndex], this.editedItem);
                axios
                    .put("/api/user/" + this.editedItem.id, this.editedItem)
                    .then(response => console.log(response.data));
            } else {
                this.users.push(this.editedItem);
                axios
                    .post("/api/user/", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
            this.$store.dispatch("loadUsers");
            // location.reload();
        }
    },
    computed: {
        users() {
            return this.$store.state.users;
        },
        labs() {
            return this.$store.state.labs;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        },
        filterUser: function() {
            return this.users.filter(user => {
                return user.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        formTitle() {
            return this.editedIndex === -1 ? "New User" : "Edit User";
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
