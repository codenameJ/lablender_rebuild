<template>
    <div id="app">
        <v-content>
            <div class="mx-auto mt-1 mb-2" max-width="1500">
                <h1 align="center" class="mt-4">LAB LENDER</h1>
                <h5 align="center">
                    Let's get started by joining labs.
                </h5>
                <h5 align="center">
                </h5>
                <v-divider></v-divider>
                <br />
                <div style="display: flex">
                    <v-card class="mx-auto" max-width="344">
                        <v-img src="/img/labhowto1.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Select lab from lab lists
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            เลือกแลปที่ต้องการเข้าร่วม
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn
                                href="/labs"
                                color="#f7797d"
                                style="text-decoration : none;"
                                text
                                right
                            >
                                OUR LABS
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                    <v-card class="mx-auto" max-width="344">
                        <v-img src="/img/labhowto2.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Send lab join request
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            กด Request เพื่อขอเข้าร่วมแลป
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn color="#5d26c1" text right>
                                LENDING CART
                            </v-btn>
                        </v-card-actions>
                    </v-card>

                    <v-card class="mx-auto" max-width="344">
                        <v-img src="/img/labhowto3.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Start lending when got accepted
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            เมื่ออาจารย์รับเข้าแลป สามารถเริ่มต้นยืมของได้ทันที
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn
                                href=""
                                color="#11998e"
                                style="text-decoration : none;"
                                text
                                right
                            >
                                YOUR REQUESTS
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </div>
            </div>
        </v-content>
    </div>
</template>

<script>
export default {
    name: "Home",
    mounted() {
        console.log("home show");
    },
};
</script>
