require("./bootstrap");
window.Vue = require("vue").default;
import { createApp } from "vue";
import checkFileStringPlugin from "./plugins.js"
import router from "./router"; // Vue Router
import mitt from "mitt";
// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import Notifications from "@kyvg/vue3-notification";
import VueCreditCardValidation from "vue-credit-card-validation";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import MainTest from "./components/test/MainTest.vue";
import MentionUser from "./components/Global/MentionUser"
import AddNewComment from "./components/Global/AddNewComment"


// Vue.component('font-awesome-icon', FontAwesomeIcon);
// import Header from './components/layout/Header.vue';
const emitter = mitt();
const app = createApp({});
app.config.globalProperties.emitter = emitter;
app.use(router, MainTest).mount("#app");
app.use(Notifications);
app.use(VueCreditCardValidation);
app.use(MainTest);
app.use(VueSweetalert2);
app.use(checkFileStringPlugin);

app.component('MentionUser' , MentionUser)
app.component('AddNewComment' , AddNewComment)

