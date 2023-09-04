<template>
  <div>
    <h1>Quotes</h1>
    <table>
      <thead>
        <tr>
          <th>Index</th>
          <th>Quote</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(quote, index) in quotes" :key="index">
          <td>{{ index + 1 }}</td>
          <td>{{ quote.quote }}</td>
          <td>
            <button @click="removeFavorites(quote.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div>
      <router-link to="/Quote"  >
        <button>
         Show Quotes
        </button>
      </router-link>
    </div>
  </div>
</template>

<script>
import { ref,onMounted,watch } from 'vue';
import   quoteServices from '../services/quoteServices';
import {useRouter} from "vue-router";
import { useAuthStore } from '../stores/auth'; // Import the Pinia store

export default {
  setup() {
    const quotes = ref([]);
    const router = useRouter();
    const user_role = ref('');

    const authStore = useAuthStore(); // Access the Pinia store
    watch(async () => {
          try {
              user_role.value=authStore.apiToken;
            } catch (e) {
              await router.push('/');
            }
          });
    const removeFavorites = async(id) => {
      const payload = {
        id: id,
        token: user_role.value
          };
      await quoteServices.deleteFavourite(payload)
              .then(async response=>{
                  getFavourite();
              })
              .catch(error => {
                
              });
    };
    const getFavourite = async() => {
          await quoteServices.getFavourite(user_role.value)
              .then(async response=>{
                quotes.value =response.data.data;
              })
              .catch(error => {
                if(error.response.status==422){
                  alert("NOt found")
                }
              });
        }

  onMounted(() => {
      getFavourite();
   });
  
    return {
      quotes,
      removeFavorites
    };
  },
};
</script>