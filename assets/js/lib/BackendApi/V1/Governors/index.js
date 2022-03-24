import axios from "axios";

export default class {

    getMine() {
        return axios.get("/api/v1/user/governor")
    }

    create(name, gameId, power, type) {
        return axios.post("/api/v1/governor", {
            name: name,
            game_id: gameId,
            power: power,
            type: type
        })
    }

    get(id) {
        return axios.get(`/api/v1/governor/${id}`)
    }

    async attributes() {
        return axios.get('/api/v1/governor/attributes')
    }
}