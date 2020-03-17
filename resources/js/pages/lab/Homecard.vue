<template>
    <div id="app" v-if="curlab">
        <v-content>
            <div class="mx-auto mt-1 mb-2" max-width="1500">
                <!-- <h1 align="center">{{ $route.params.course_id }}</h1> -->
                <!-- <h1 align="center">LAB LENDER</h1> -->
                <h1 align="center">{{ curlab.course_name }}</h1>
                <h2 align="center">{{ curlab.course_id }}</h2>
                <br>
                <h5 align="center">
                    Easy steps to lend any equipments in the lab!
                </h5>
                <v-divider></v-divider>
                <br />
                <div style="display: flex">
                    <v-card class="mx-auto" max-width="344">
                        <v-img src="/img/howto1.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Select equipments to lend
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            เลือกอุปกรณ์ที่ต้องการยืม
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn
                                href="/equipment"
                                color="#0091EA"
                                style="text-decoration : none;"
                                text
                                right
                            >
                                SEE EQUIPMENTS
                            </v-btn>

                            <!-- <v-btn icon @click="show = !show">
                        <v-icon>{{
                            show ? "mdi-chevron-up" : "mdi-chevron-down"
                        }}</v-icon>
                    </v-btn> -->
                        </v-card-actions>
                    </v-card>
                    <v-card class="mx-auto" max-width="344">
                        <v-img src="/img/howto2.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Confirm your lend request
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            ยืนยันส่งคำขอยืม
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn color="green darken-3" text right>
                                LENDING CART
                            </v-btn>

                            <!-- <v-btn icon @click="show = !show">
                        <v-icon>{{
                            show ? "mdi-chevron-up" : "mdi-chevron-down"
                        }}</v-icon>
                    </v-btn> -->
                        </v-card-actions>
                    </v-card>
                    <v-card class="mx-auto" max-width="344">
                        <v-img src="/img/howto3.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Recieve your equipments
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            รับอุปกรณ์เมื่อคำขอเปลี่ยนสถานะเป็น Ready
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn
                                href="/request"
                                color="pink accent-2"
                                style="text-decoration : none;"
                                text
                                right
                            >
                                YOUR REQUESTS
                            </v-btn>

                            <!-- <v-btn icon @click="show = !show">
                        <v-icon>{{
                            show ? "mdi-chevron-up" : "mdi-chevron-down"
                        }}</v-icon>
                    </v-btn> -->
                        </v-card-actions>
                    </v-card>
                </div>
            </div>
        </v-content>
    </div>
</template>

<script>
export default {
    // props: ["course_id"],
    data: () => ({}),
    mounted() {
        // this.getLabData();
    },
    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        },
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
