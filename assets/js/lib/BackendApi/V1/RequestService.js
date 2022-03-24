import axios from "axios"
import errorHandler from "../errors";
import showToast from "../../UI/Toasts";

class RequestService
{
    constructor() {
        this.reqOptions = {
            timeout: 5000,
        }
        this.client = axios.create(this.reqOptions);
    }

    getHeaders() {
        return {
            "Content-Type": "application/json"
        }
    }

    async request(method, url, data) {
        try {
            const res = await this.client.request({
                method: method,
                url: url,
                headers: this.getHeaders(),
                data: data
            })
            return res.data.data;
        } catch (e) {
            if (e.response) {
                const errors = e.response.data.errors;
                if (errors) {
                    errors.forEach(error => showToast(error.message));
                    return;
                }
            }
            console.log(e);
            showToast("An Unknown error occurred");
        }
    }
}