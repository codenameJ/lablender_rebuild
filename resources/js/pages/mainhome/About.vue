<template>
    <div id="app">
        <v-app id="inspire">
            <v-card class="mt-4 elevation-4 d-inline-block mx-auto" style="max-width:auto; max-height:auto">
                <div class="flex-container">
                <v-container>
                            <!-- ml-12 mt-5 mb-3  -->
                            <center>
                            <v-img
                                class="m-5 homepic justify-center"
                                src="/img/cpe.png"
                            />
                            </center>
                            <center>
                            
                            <v-col
                                style="font-size: 18px; font-family: 'Kanit' , sans-serif;"
                                align="center"
                                class="mt-2"
                            >
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
                            <br>
                            
                            </center>
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

div.homepic {
}

@media screen and (min-width: 801px) {
    div.homepic {
        width: 15vw;
        text-align: center;
    }
}

@media screen and (max-width: 800px) {
    div.homepic {
        width: 40vw;
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
