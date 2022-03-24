import axios from "axios";

export default class {

    getAll() {
        return axios.get("/api/v1/kingdom");
    }

    create(number, seed, isCouncilDriven, focus, migration_status, governor_id) {
        return axios.post("/api/v1/kingdom", {
            number: number,
            seed: seed,
            council_driven: isCouncilDriven,
            focus: focus,
            migration_status: migration_status,
            governor_id: governor_id
        })
    }

    get(name) {
        return axios.get(`/api/v1/kingdom/${name}`)
    }

    attributes() {
        return axios.get(`/api/v1/kingdom/attributes`)
    }
}