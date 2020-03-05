<template>
    <div id="app">
        <v-app id="inspire">
            <v-card class="mt-4 elevation-4 d-inline-block mx-auto" style="max-width:80vw; max-height:90vh;">
                <div class="flex-container">
                <v-container>
                    <v-row justify="space-between">
                        <v-col cols="auto">
                            <center>
                            <v-img
                             class="ml-3 align-center" 
                             src="/img/cpe.png"
                             max-width="80%"
                            max-height="80%"
                             ></v-img>
                            </center>
                        </v-col>

                        <v-col cols="auto" class="text-center pl-0">
                            <v-row
                                class="flex-column ma-0 fill-height"
                                justify="center"
                            >
                                <v-col style="font-size: calc(0.6em + 0.6vw); font-family: 'Kanit' , sans-serif;" align="center" class="mt-7 mx-3">
                                    เว็บไซต์นี้พัฒนาโดยนักศึกษาวิชาภาควิชาวิศวกรรมคอมพิวเตอร์
                                    มหาวิทยาลัยเชียงใหม่ (CPE#25)<br />
                                    ภาควิชาวิศวกรรมคอมพิวเตอร์ ชั้น 4 ตึก 30 ปี
                                    คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่<br />
                                    239 ถนนห้วยแก้ว ตำบลสุเทพ อำเภอเมือง
                                    จังหวัดเชียงใหม่ 50200<br />
                                    Tel: 08-4614-0006, 0-5394-2023<br />
                                    Fax: 0-5394-2072<br />
                                    E-mail: cpe@eng.cmu.ac.th<br />
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-container>
                </div>
            </v-card>
        </v-app>
    </div>
</template>

<style scoped>

div.flex-container {
    display: flex;
}

@media screen and (min-width: 961px) {
    div.flex-container {
        flex-direction: row;
    }
}

@media screen and (max-width: 960px) {
    div.flex-container {
        flex-direction: column;
    }
}

</style>
<script>
export default {
    name: "About",
    mounted() {
        console.log("About");
    }
};
</script>
