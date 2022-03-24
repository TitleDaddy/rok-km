import axios from "axios";

export default class {

    getAll() {
        return axios.get("/api/v1/news");
    }

    create(title, body) {
        return axios.post("/api/v1/news", {
            title: title,
            body: body
        })
    }
}