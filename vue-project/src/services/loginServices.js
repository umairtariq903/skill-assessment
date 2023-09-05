import axios from "axios";

export const authClient = axios.create({
   baseURL: 'http://localhost:80/api',

});

export default {
    async login(payload) {
        return await authClient.post("/user/"+payload.password);
    },
};
