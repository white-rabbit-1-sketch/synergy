/// <reference path="../../../../../env.d.ts" />

import "../assets/style/global.css";
import "../../../../../node_modules/flag-icons/css/flag-icons.min.css";

import { createApp } from 'vue'
import App from './App.vue'
import {container} from "@/container";
import {mountApp} from "../../../../common/src/vue-app";
import router from "@/router";
import {AluneaDomService} from "../../../../common/src/service/alunea-dom-service";
import {ContextService} from "../../../../common/src/service/context-service";
const aluneaDom = container.get(AluneaDomService);
const contextService = container.get(ContextService);
contextService.setContext(ContextService.CONTEXT_SITE);

document.addEventListener('DOMContentLoaded', async () => {
    const appMountPoint = aluneaDom.createAppMountPoint();
    mountApp(createApp(App).use(router), appMountPoint, () => {

    });
});