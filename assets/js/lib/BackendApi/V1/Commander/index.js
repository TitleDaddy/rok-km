import axios from "axios";
import errorHandler from "../../errors";

export default class {

    async getAll() {
        try {
            const res = await axios.get("/api/v1/commander");
            return res.data.data;
        } catch (e) {
            errorHandler(e);
        }
    }

    async create(name, features, rarity, obtained_from, kingdom_age) {
        try {
            const res = await axios.post("/api/v1/commander", {
                name: name,
                features: features,
                rarity: rarity,
                obtained_from: obtained_from,
                kingdom_age: kingdom_age,
            });
            return res.data.data;
        } catch (e) {
            errorHandler(e);
        }
    }

    async get(name) {
        try {
            const res = axios.get(`/api/v1/commander/${name}`);
            return res.data.data;
        } catch (e) {
            errorHandler(e);
        }
    }

    async update(name, features, rarity, obtained_from, kingdom_age) {
        try {
            const res = await axios.post(`/api/v1/commander/${name}`, {
                name: name,
                features: features,
                rarity: rarity,
                obtained_from: obtained_from,
                kingdom_age: kingdom_age,
            })
            return res.data.data;
        } catch (e) {
            errorHandler(e);
        }
    }

    attributes() {
        
         axios.get("/api/v1/commander/attributes");
    }
}