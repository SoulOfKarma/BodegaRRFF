<template>
    <div>
        <div class="vx-row">
            <div
                class="router-header flex flex-wrap items-center mb-6"
                style="margin-left:10px;"
            ></div>
        </div>
        <div class="vx-row">
            <!-- <div class="vx-col w-full lg:w-1/4 mb-base"></div> -->
            <div class="vx-col w-full mb-base">
                <vx-card
                    slot="no-body"
                    class="text-center bg-primary-gradient greet-user"
                >
                    <feather-icon
                        icon="SunIcon"
                        class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow"
                        svgClasses="h-8 w-8"
                    ></feather-icon>
                    <h1 class="mb-6 text-white">Bienvenido!</h1>
                    <p
                        class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white"
                    >
                        Sistema de Inventario RRFF -
                        <strong>Hospital San Juan de Dios</strong>.
                    </p>
                </vx-card>
            </div>
            <!-- <div class="vx-col w-full lg:w-1/4 mb-base"></div> -->
        </div>
        <div class="vx-row">
            <!-- <div class="vx-col w-full lg:w-1/4 mb-base"></div>-->
            <!-- <div class="vx-col w-full lg:w-1/2 mb-base">  -->
            <div class="vx-col w-full lg:w-full mb-base">
                <vx-card title="Informacion del Perfil">
                    <vx-timeline :data="timelineData" />
                </vx-card>
            </div>
            <!-- </div> -->
            <!-- <div class="vx-col w-full lg:w-1/4 mb-base"></div> -->
        </div>
    </div>
</template>
<script>
import axios from "axios";
import VxTimeline from "@/components/timeline/VxTimeline";
import router from "@/router";
export default {
    components: {
        VxTimeline
    },
    data() {
        return {
            externalVal: process.env.MIX_APP_URL_EXTERNA,
            timelineData: [
                {
                    color: "danger",
                    icon: "UsersIcon",
                    title: "Inicio",
                    desc:
                        "Encontrarás el acceso a la pantalla de Inicio y Al menu de Ingreso del Inventario, Stock disponible de RRFF y Asignacion de Material a las OT En el Menu de la izquierda"
                }
            ]
        };
    }
};
</script>
<style lang="scss">
@import "@sass/vuexy/components/vxTimeline.scss";
</style>
