<template>
    <div id="app" v-if="curlab">
        <v-content>
            <div class="mx-auto mt-1 mb-2" max-width="1500">
                <v-row>
                    <div>
                        <h1 class="ml-5 mb-5" align="left">Dashboard</h1>
                        <!-- <h4 class="ml-5" align="left">
                            {{ curlab.course_name }} : {{ curlab.course_id }}
                        </h4> -->
                    </div>
                    <!-- <v-spacer></v-spacer>
                    <h5 class="mr-5 mb-5" align="right">Welcome, professor name</h5> -->
                </v-row>
            </div>
            <div class="flex-container">

            <v-card class="mt-6 mb-6 mx-auto" max-width="500">
                <v-sheet
                    class="v-sheet--offset mx-auto"
                    color="success"
                    elevation="12"
                    max-width="calc(100% - 32px)"
                >
                    <v-img src="/img/frequent.png"></v-img>
                </v-sheet>
                <v-card-text class="pt-0">
                    <v-data-table
                        :headers="headers_frequent"
                        :items="items_frequent"
                        :items-per-page="5"
                        class="elevation-1"
                    ></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light"
                        >สามารถตรวจสอบคำขอยืมอุปกรณ์ทั้งหมดได้ที่หน้าคำขอยืม</span
                    >
                </v-card-text>
            </v-card>

            <v-card class="mt-6 mb-6 mx-auto" max-width="500">
                <v-sheet
                    class="v-sheet--offset mx-auto"
                    color="error"
                    elevation="12"
                    max-width="calc(100% - 32px)"
                >
                    <v-img src="/img/broken.png"></v-img>
                </v-sheet>
                <v-card-text class="pt-0">
                    <v-data-table
                        :headers="headers"
                        :items="items"
                        :items-per-page="5"
                        class="elevation-1"
                    ></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light"
                        >สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span
                    >
                </v-card-text>
            </v-card>

            <v-card class="mt-6 mb-6 mx-auto" max-width="500">
                <v-sheet
                    class="v-sheet--offset mx-auto"
                    color="amber accent-4"
                    elevation="12"
                    max-width="calc(100% - 32px)"
                >
                    <v-img src="/img/missing.png"></v-img>
                </v-sheet>
                <v-card-text class="pt-0">
                    <v-data-table
                        :headers="headers"
                        :items="items"
                        :items-per-page="5"
                        class="elevation-1"
                    ></v-data-table>
                    <v-divider class="my-2"></v-divider>
                    <v-icon class="mr-2" small>
                        build
                    </v-icon>
                    <span class="caption grey--text font-weight-light"
                        >สามารถตรวจสอบรายการทั้งหมดได้ที่หน้าบำรุงรักษา</span
                    >
                </v-card-text>
            </v-card>



            </div>
        </v-content>
    </div>
</template>

<script>
export default {
    // props: ["course_id"],
    data: () => ({
        headers: [
          {
            text: 'Equipment ID',
            align: 'start',
            value: 'equip_id',
          },
          { text: 'Equipment Name', 
          value: 'equip_name' },
          { text: 'QTY', 
          value: 'equip_qty' },
        ],

        items: [
          {
            equip_id: '10001',
            equip_name: 'Pork Belly',
            equip_qty: '1',
          },
          {
            equip_id: '10002',
            equip_name: 'Jarikka Belly',
            equip_qty: '1',
          },
        ],

        headers_frequent: [
          {
            text: 'Equipment ID',
            align: 'start',
            value: 'equip_id',
          },
          { text: 'Equipment Name', 
          value: 'equip_name' },
          { text: 'Lending counts', 
          value: 'equip_counts' },
        ],
        
        items_frequent: [
          {
            equip_id: '10001',
            equip_name: 'Pork Belly',
            equip_counts: '17',
          },
          {
            equip_id: '10002',
            equip_name: 'Jarikka Belly',
            equip_counts: '15',
          },
        ],

      }
    ),

    mounted() {
        // this.getLabData();
    },
    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        }
    }
};
</script>

<style scoped>
div.flex-container {
    display: flex;
}

@media screen and (min-width: 1641px) {
    div.flex-container {
        flex-direction: row;
    }
}

@media screen and (max-width: 1640px) {
    div.flex-container {
        flex-direction: column;
    }
}
</style>
