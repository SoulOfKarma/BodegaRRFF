/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

const router = new Router({
    mode: "history",
    base: "/",
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: "",
            redirect: "/pages/login"
        },

        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: "",
            component: () => import("./layouts/main/Main.vue"),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: "/home",
                    name: "home",
                    component: () => import("./views/Home.vue")
                },
                {
                    path: "/entregaMaterial",
                    name: "entregamaterial",
                    component: () =>
                        import("./views/Bodega/EntregaMaterialNSolicitud.vue")
                },
                {
                    path: "/listadoSolicitudes",
                    name: "listadosolicitudes",
                    component: () =>
                        import("./views/Bodega/ListadoSolicitudes.vue")
                },
                {
                    path: "/materialNuevo",
                    name: "materialnuevo",
                    component: () => import("./views/Bodega/MaterialNuevo.vue")
                },
                {
                    path: "/stockMaterialIngresado",
                    name: "stock",
                    component: () =>
                        import("./views/Bodega/StockMaterialIngresado.vue")
                },
                {
                    path: "/stockTotal",
                    name: "stockTotal",
                    component: () => import("./views/Bodega/StockTotal.vue")
                },
                {
                    path: "/devolucionMaterialAdicional",
                    name: "devolucionMaterialAdicional",
                    component: () =>
                        import("./views/Bodega/RetornarMaterialAdicional.vue")
                },
                {
                    path: "/seguimientoMaterial/:id",
                    name: "seguimientoMaterial",
                    component: () =>
                        import("./views/Bodega/SeguimientoMaterial.vue")
                },
                {
                    path: "/modificarMaterial/:id",
                    name: "modificarMaterial",
                    component: () =>
                        import("./views/Bodega/ModificarMaterialIngresado.vue")
                },
                {
                    path: "/entregaMaterialNSolicitud/:id,:uuid,:id_categoria",
                    name: "entregaMaterialNSolicitud",
                    component: () =>
                        import("./views/Bodega/EntregaMaterialNSolicitud.vue")
                },
                {
                    path: "/listadoMaterialEntregado",
                    name: "listadoMaterialEntregado",
                    component: () =>
                        import("./views/Bodega/ListadoMaterialEntregado.vue")
                },
                {
                    path: "/retornarMaterialList",
                    name: "retornarMaterialList",
                    component: () =>
                        import("./views/Bodega/RetornarMaterialList.vue")
                }
            ]
        },
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: "",
            component: () => import("@/layouts/full-page/FullPage.vue"),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: "/pages/login",
                    name: "page-login",
                    component: () => import("@/views/pages/Login.vue")
                },
                {
                    path: "/pages/error-404",
                    name: "page-error-404",
                    component: () => import("@/views/pages/Error404.vue")
                }
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: "*",
            redirect: "/pages/error-404"
        }
    ]
});

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById("loading-bg");
    if (appLoading) {
        appLoading.style.display = "none";
    }
});

export default router;
