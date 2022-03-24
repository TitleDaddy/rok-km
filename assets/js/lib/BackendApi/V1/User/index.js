import axios from "axios";
import BackendApi from "../../index";

export default class {

    whoAmI() {
        return axios.get("/api/v1/user/whoami")
    }

    async amIAdmin() {
        try {
            const res = await BackendApi.V1.User.whoAmI();
            if (res) {
                if (res.data.data.roles.includes('ROLE_USER')) {
                    return true;
                }
            }
        } catch (e) {}
        return false;
    }

    async id() {
        try {
            const res = await BackendApi.V1.User.whoAmI();
            if (res) {
                return res.data.data.id;
            }
            return null;
        } catch (e) {
            return null;
        }
    }
}