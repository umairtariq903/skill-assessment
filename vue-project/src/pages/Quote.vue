<template>
  <div>
    <h1>Best Keyne west Song</h1>
    <iframe width="420" height="315"
      src="https://www.youtube.com/embed/TfpiHv1kP5E?si=n22foM9kG3y_hcX9">
    </iframe>
  </div>
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
          <td>{{ quote }}</td>
          <td>
            <button @click="addToFavorites(quote)">Add_favorite</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div>
      <router-link to="/FavoriteQuotes"  >
        <button>
         Favorite Quotes
        </button>
      </router-link>
    </div>
      <div>
    <button @click="getQuotes()">Refresh Quotes</button>
    </div>
  </div>
</template>

<script>
import { ref, onMounted,watch } from 'vue';
import {useRouter} from "vue-router";
import   quoteServices from '../services/quoteServices';
import { useAuthStore } from '../stores/auth'; 
import { useQuotesStore } from '../stores/quotes';// Import the Pinia store

export default {
  setup() {
    const quotes = ref([]);
    const router = useRouter();
    const authStore = useAuthStore(); // Access the Pinia store
    const user_role = ref('');
    const quoteStore = useQuotesStore()

    watch(async () => {
            try {
                user_role.value=authStore.apiToken;
              } catch (e) {
                await router.push('/');
              }
            });
    
    const addToFavorites = async(quote) => {
      const payload = {
        quote: quote,
        token: user_role.value
          };
      await quoteServices.saveFavourite(payload)
              .then(async response=>{
                router.push('/FavoriteQuotes');
              })
              .catch(error => {
                if(error.response.status==422){
                 alert("Enter correct Password")
                }
              });
    };
    const getQuotes = async() => {
          await quoteServices.getQuotes(user_role.value)
              .then(async response=>{
               quoteStore.clearQuotes();
                quoteStore.setQuotes(response.data.data);
                Quotes();
              })
              .catch(error => {
                if(error.response.status==422){
                 alert("Enter correct Password")
                }
              });
        }
        const Quotes = async() => {
           quotes.value=quoteStore.getStoredQuotes;
        }

  onMounted(() => {
    Quotes();
   });


    return {
      quotes,
      addToFavorites,
      getQuotes
    };
  },
};
</script>