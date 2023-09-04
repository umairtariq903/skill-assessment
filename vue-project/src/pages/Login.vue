<template>
  <div class="login">
    <h2>Login</h2>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import { ref,onMounted,watch } from 'vue';
import   loginServices from '../services/loginServices'
import {useRouter} from "vue-router";
import { useAuthStore } from '../stores/auth'; // Import the Pinia store


export default {
  setup() {
    const password = ref('');
    const router = useRouter();
    const authStore = useAuthStore(); // Access the Pinia store

    const submit = async() => {
          const payload = {
            password: password.value,
          };


          await loginServices.login(payload)
              .then(async response=>{
                  authStore.setApiToken(response.data.data.api_token);
                  router.push('/Quote');
              })
              .catch(error => {
                
              });
        }

    return { 
       password, 
       submit, 
      };
  },
};
</script>

<style scoped>
.login {
  max-width: 300px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-group {
  margin-bottom: 10px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
../services/loginServices