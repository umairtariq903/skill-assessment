import axios from "axios";

export const authClient = axios.create({
   baseURL: 'http://localhost:80/api',

});

export default {
    async getQuotes(payload) {
        return await authClient.get("/quotes/5/1?api_token="+payload);
    },
    async saveFavourite(payload) {
        return await authClient.post("/favourite/"+payload.quote+"?api_token="+payload.token);
    },
    async getFavourite(payload) {
        return await authClient.get("/favourite/?api_token="+payload);
    },
    async deleteFavourite(payload) {
        return await authClient.delete("/favourite/"+payload.id+"?api_token="+payload.token);
    },
};
