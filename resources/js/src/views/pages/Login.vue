<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div
        class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
        id="page-login"
    >
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row no-gutter justify-center items-center">
                        <div class="vx-col hidden lg:block lg:w-1/2">
                            <img
                                src="@assets/images/pages/login.png"
                                alt="login"
                                class="mx-auto"
                            />
                        </div>

                        <div
                            class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg"
                        >
                            <div class="p-8 login-tabs-container">
                                <div class="vx-card__title mb-4">
                                    <h4 class="mb-4">Inicio de Sesion</h4>
                                    <p>
                                        Bienvenido al sistema de Bodega de RRFF
                                    </p>
                                </div>

                                <div>
                                    <vs-input
                                        name="run"
                                        icon="icon icon-user"
                                        icon-pack="feather"
                                        label-placeholder="Run"
                                        v-model="run"
                                        v-on:blur="formatear_run"
                                        class="w-full no-icon-border"
                                    />
                                    <span
                                        style="font-size: 10px; color: red; margin-left: 10px;"
                                        v-if="val_run"
                                        >Run incorrecto</span
                                    >

                                    <vs-input
                                        type="password"
                                        name="password"
                                        icon="icon icon-lock"
                                        icon-pack="feather"
                                        label-placeholder="Contraseña"
                                        v-model="password"
                                        @keyup.native.enter="validarSesion"
                                        class="w-full mt-6 no-icon-border"
                                    />
                                    <br />
                                    <input
                                        type="hidden"
                                        name="_token"
                                        :value="csrf_token"
                                    />
                                    <!-- <router-link to="../Home"> -->
                                    <div slot="footer">
                                        <vs-row vs-justify="flex-end">
                                            <vs-button
                                                class="fixedHeight"
                                                @click="validarSesion"
                                                icon="home"
                                                >Ingresar</vs-button
                                            >
                                        </vs-row>
                                    </div>

                                    <!-- </router-link> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router";
import { validate, clean, format } from "rut.js";

export default {
    data() {
        return {
            run: "",
            password: "",
            val_run: false,
            checkbox_remember_me: false,
            localVal: process.env.MIX_APP_URL
        };
    },
    computed: {
        csrf_token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content;
        }
    },
    methods: {
        async validarSesion() {
            if (
                this.run == "" ||
                this.run == null ||
                this.password == "" ||
                this.password == null
            ) {
                this.$vs.notify({
                    color: "danger",
                    title: "Datos de sesion",
                    text: "Run o Contraseña no Ingresada"
                });
            } else {
                this.run = format(this.run);
                if (validate(this.run)) {
                    var sw = 0;
                    var pr = 0;
                    var permiso_usuario = "";
                    let objeto = { rut: this.run, password: this.password };
                    await axios
                        .post(this.localVal + "/api/Login/GetUsers", objeto)
                        .then(response => {
                            if (response.data.length > 0) {
                                if (response.data != 1) {
                                    sessionStorage.setItem(
                                        "nombre",
                                        response.data[0].nombre_usuario
                                    );
                                    sessionStorage.setItem(
                                        "apellido",
                                        response.data[0].apellido_usuario
                                    );
                                    sessionStorage.setItem(
                                        "run",
                                        response.data[0].run
                                    );
                                    sessionStorage.setItem(
                                        "id",
                                        response.data[0].id
                                    );
                                    sw = 1;
                                }
                            } else {
                                pr = 1;
                            }
                        })
                        .catch(error => console.log(error));
                    await axios
                        .post(this.localVal + "/api/auth/login", {
                            run: sessionStorage.getItem("run"),
                            password: this.password
                        })
                        .then(function(response) {
                            sessionStorage.setItem(
                                "token",
                                response.data.token
                            );
                        })
                        .catch(error => console.log(error));
                    console.log(sw);
                    if (sw == 1) {
                        await axios
                            .post(this.localVal + "/api/Login/getpr", {
                                rut: this.run,
                                password: this.password
                            })
                            .then(function(response2) {
                                if (response2.data.length > 0) {
                                    if (response2.data[0].estado_login == 1) {
                                        sessionStorage.setItem(
                                            "permiso_usuario",
                                            response2.data[0].permiso_usuario
                                        );
                                        if (
                                            response2.data[0].permiso_usuario ==
                                            1
                                        ) {
                                            pr = 3;
                                        } else if (
                                            response2.data[0].permiso_usuario ==
                                            2
                                        ) {
                                            pr = 4;
                                        }

                                        //router.push('/home');
                                        //pr = 3;
                                    } else {
                                        pr = 2;
                                    }
                                }
                            });
                    }
                    if (pr == 1) {
                        this.$vs.notify({
                            color: "danger",
                            title: "Login",
                            text: "Usuario y/o Contraseña Incorrectos."
                        });
                    }
                    if (pr == 2) {
                        this.$vs.notify({
                            color: "danger",
                            title: "Login",
                            text: "Usted no posee acceso a la plataforma."
                        });
                    }
                    if (pr == 3 || pr == 4) {
                        //localStorage.setItem('run',response2.data[0].permiso_usuario);
                        router.push("/home");
                    } else {
                        this.val_run = true;
                    }
                }
            }
        },
        formatear_run() {
            this.run = format(this.run);
            this.val_run = !validate(this.run);
        }
    }
};
</script>
