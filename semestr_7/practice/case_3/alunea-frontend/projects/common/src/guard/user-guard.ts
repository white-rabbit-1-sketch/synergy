import log from "loglevel";
import {container} from "../ioc/container";
import {SecurityService} from "../service/security-service";
import {AppService} from "../service/app-service";

const securityService = container.get(SecurityService);
const appService = container.get(AppService);

export function canActivate() {
    return async function (to, from, next) {
        await appService.waitUntilInitialized();

        const userOverview = securityService.getCurrentUserOverview();

        if (userOverview) {
            log.debug('✅🟢 User guard is granted', userOverview.getUser());
            next();
        } else {
            log.debug('✅🔴 User guard is denied');
            next('/signin');
        }
    };
}
