<template>
    <div id="app">
        <v-content class="my-8">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <v-data-table
                        :headers="headers"
                        :items="users"
                        class="elevation-1"
                    >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>User</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
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
                                    <v-card>
                                        <v-card-title>
                                            <span class="headline">{{
                                                formTitle
                                            }}</span>
                                        </v-card-title>

                                        <v-form
                                            ref="form"
                                            v-model="valid"
                                            lazy-validation
                                        >
                                            <v-card-text>
                                                <v-container>
                                                    <!-- <v-row>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="editedItem.User_id"
                                                    label="User ID"
                                                ></v-text-field>
                                            </v-col> -->
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="4"
                                                    >
                                                        <v-text-field
                                                            v-model="
                                                                editedItem.Name
                                                            "
                                                            label="User Name"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        md="4"
                                                    >
                                                        <v-text-field
                                                            v-model="
                                                                editedItem.Email
                                                            "
                                                            :rules="emailRules"
                                                            label="E-mail"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="
                                                                    editedItem.Password
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
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="
                                                                    editedItem.Phone
                                                                "
                                                                :counter="10"
                                                                :rules="
                                                                    phoneRules
                                                                "
                                                                label="Phone"
                                                                type="number"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-select
                                                                v-model="
                                                                    editedItem.Type
                                                                "
                                                                :items="
                                                                    selecttype
                                                                "
                                                                label="Type"
                                                                item-text="name"
                                                                return-object
                                                                chips
                                                            ></v-select>
                                                        </v-col>

                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-if="
                                                                    editedItem.Type ==
                                                                        'ta'
                                                                "
                                                                v-model="
                                                                    editedItem.Lab
                                                                "
                                                                label="Lab ID"
                                                            ></v-text-field>

                                                            <v-text-field
                                                                v-if="
                                                                    editedItem.Type ==
                                                                        'student'
                                                                "
                                                                v-model="
                                                                    editedItem.Stdid
                                                                "
                                                                label="Student ID"
                                                            ></v-text-field>
                                                        </v-col>

                                                        <!-- <v-col cols="12" sm="6" md="4">
                                                    <v-select
                                                        v-model="
                                                            editedItem.Activation
                                                        "
                                                        :items="
                                                            selectactivation
                                                        "
                                                        label="Activation"
                                                        item-text="name"
                                                        return-object
                                                        chips
                                                    ></v-select>
                                                </v-col> -->
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>
                                        </v-form>

                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                color="blue darken-1"
                                                text
                                                @click="close"
                                                >Cancel</v-btn
                                            >
                                            <v-btn
                                                :disabled="!valid"
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
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="getUserData"
                                >Reset</v-btn
                            >
                        </template>
                    </v-data-table>
                </div>
            </div>
        </v-content>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getUserData();
    },
    data: () => ({
        valid: true,
        emailRules: [
            v => !!v || "E-mail is required",
            v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        ],
        phoneRules: [
            v => !!v || "Phone number is required.",
            v => (v && v.length <= 10) || "Phone number must be valid"
        ],
        // return {
        value: String,
        dialog: false,
        search: "",
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
            // { text: "created at", value: "created_at" },
            // { text: "updated at", value: "updated_at" },
            { text: "Actions", value: "action", sortable: false }
        ],
        users: [],
        // tas: [],
        // students: [],
        editedIndex: -1,
        editedItem: {
            name: "",
            email: "",
            phone: 0,
            type: "",
            Lab: 0,
            Stdid: 0
        },
        defaultItem: {
            name: "",
            email: "",
            phone: 0,
            type: "",
            Lab: 0,
            Stdid: 0
        },
        selectactivation: ["Yes", "No"],
        selecttype: ["student", "ta", "admin"]
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New User" : "Edit User";
        },
        filterUser: function() {
            return this.users.filter(us => {
                return us.Name.match(this.search);
            });
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {
        this.getUserData();
    },

    methods: {
        validate() {
            if (this.$refs.form.validate()) {
                this.snackbar = true;
            }
        },

        getUserData() {
            axios.get("/api/user").then(Response => {
                this.users = Response.data;
                console.log(this.users);
            });
        },

        editItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.users.indexOf(item.User_id);
            confirm("Are you sure you want to delete this item?") &&
                this.users.splice(index, 1);

            axios
                .delete("api/user/" + item.User_id)
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
            // edit user
            if (this.editedIndex > -1) {
                Object.assign(this.users[this.editedIndex], this.editedItem);
                axios
                    .put("api/user/" + this.editedItem.User_id, this.editedItem)
                    .then(response => console.log(response.data));

                if (this.editedItem.Type === "ta") {
                    axios
                        .put(
                            "/api/ta/" + this.editedItem.User_id,
                            this.editedItem
                        )
                        .then(response => console.log(response.data));
                }

                if (this.editedItem.Type === "student") {
                    axios
                        .put(
                            "/api/student/" + this.editedItem.User_id,
                            this.editedItem
                        )
                        .then(response => console.log(response.data));
                }
            } else {
                // add new user
                this.users.push(this.editedItem);
                axios
                    .post("api/user", this.editedItem)
                    .then(response => console.log(response.data));

                if (this.editedItem.Type === "ta") {
                    axios
                        .post("/api/ta", this.editedItem)
                        .then(response => console.log(response.data));
                }

                if (this.editedItem.Type === "student") {
                    axios
                        .post("/api/student", this.editedItem)
                        .then(response => console.log(response.data));
                }
            }
            this.close();
            location.reload();
        }
    }
};
</script>
