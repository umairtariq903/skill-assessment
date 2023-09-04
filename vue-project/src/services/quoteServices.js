import axios from "axios";

export const authClient = axios.create({
   baseURL: 'http://127.0.0.1:8000/api',

});

export default {
    async getQuotes(payload) {
        return await authClient.get("/getQuotes/5?api_token="+payload);
    },
    async saveFavourite(payload) {
        return await authClient.post("/saveFavourite/"+payload.quote+"?api_token="+payload.token);
    },
    async getFavourite(payload) {
        return await authClient.get("/getFavourite/?api_token="+payload);
    },
    async deleteFavourite(payload) {
        return await authClient.post("/deleteFavourite/"+payload.id+"?api_token="+payload.token);
    },
};
