<template>
    <div id="app">
        <v-dialog v-model="dialogcart" max-width="500px">
            <template v-slot:activator="{ on }">
                <v-badge class="mr-4">
                    <span slot="badge">{{ showBadge }}</span>
                    <v-icon v-on="on">shopping_cart</v-icon>
                </v-badge>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline"
                        >Lending Cart<v-icon class="ml-2"
                            >shopping_cart</v-icon
                        ></span
                    >
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <p v-if="this.viewCart.length == 0">
                                <center>
                                    Your Lending Cart is empty.
                                </center>
                            </p>
                            <table class="table table-striped text left">
                                <tr
                                    v-for="(cart, i) in viewCart"
                                    v-bind:key="i"
                                >
                                    <td class="my-auto">
                                        {{ cart.equip_name }}
                                    </td>
                                    <td class="my-auto">
                                        {{ cart.amount }}
                                    </td>
                                    <td>
                                        <v-btn
                                            small
                                            class="my-auto"
                                            color="error"
                                            text
                                            @click="removeCart(i)"
                                            >delete</v-btn
                                        >
                                    </td>
                                </tr>
                            </table>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        v-if="this.viewCart.length == 0"
                        color="blue darken-1"
                        text
                        @click="closecart"
                        >Close</v-btn
                    >
                    <v-btn
                        v-if="this.viewCart.length != 0"
                        color="blue darken-1"
                        text
                        @click="closecart"
                        >Cancel</v-btn
                    >
                    <v-btn
                        v-if="this.viewCart.length != 0"
                        color="#1a73e8"
                        style="text-decoration:none"
                        class="white--text"
                        @click="CheckOut"
                        >Check Out
                    </v-btn>
                    <v-btn
                        v-if="this.viewCart.length == 0"
                        color="#1a73e8"
                        style="text-decoration:none"
                        class="white--text"
                        disabled
                        >Check Out
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    mounted() {},
    data: () => ({
        dialogcart: false,
        badge: 0,
        getcart: null,
        storestatus: false
    }),

    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        },
        currentuser() {
            return this.$store.state.selectedUser;
        },
        viewCart() {
            return this.$store.state.cart;
        },
        showBadge() {
            this.badge = this.viewCart.length;
            return this.badge;
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {},

    methods: {
        removeCart(index) {
            this.$store.commit("removeFromCart", index);
        },
        ClearCart() {
            this.$store.commit("SetNewCart", this.viewCart.length);
        },
        closecart() {
            this.dialogcart = false;
        },
        CheckOut() {
            this.getcart = this.viewCart;
            console.log(this.getcart);
            if (confirm("Confirm your lending")) {
                axios
                    .post("/api/requestlist/", {
                        cart: this.getcart,
                        student_id: this.currentuser.student.id,
                        lab_id: this.curlab.id
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadEquipments");
                this.$store.dispatch("clearCartItems");
                this.closecart();
            }
        }
    }
};
</script>
