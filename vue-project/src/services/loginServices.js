import axios from "axios";

export const authClient = axios.create({
   baseURL: 'http://127.0.0.1:8000/api',

});

export default {
    async login(payload) {
        return await authClient.post("/getUser/"+payload.password);
    },
};
