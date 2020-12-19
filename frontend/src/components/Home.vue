<template>
  <div>

    <ListPokemon
      v-if="pokemonsArray"
      :pokemonsArray="pokemonsArray"
      :pageActuelle="currentPage"
    />

    <a href="#" id="page" @click="getResults(currentPage-1)" v-if="currentPage!=1">Précédent</a>
    <a href="#" id="page" @click="getResults(1)" v-bind:class="{ pageActive: currentPage == 1 }">1</a>
    <a href="#" id="page" @click="getResults(2)" v-bind:class="{ pageActive: currentPage == 2 }">2</a>
    <a href="#" id="page" @click="getResults(3)" v-bind:class="{ pageActive: currentPage == 3 }">3</a>
    <a href="#" id="page" @click="getResults(4)" v-bind:class="{ pageActive: currentPage == 4 }">4</a>
    <a href="#" id="page" @click="getResults(5)" v-bind:class="{ pageActive: currentPage == 5 }">5</a>
    <a href="#" id="page" @click="getResults(6)" v-bind:class="{ pageActive: currentPage == 6 }">6</a>
    <a href="#" id="page" @click="getResults(7)" v-bind:class="{ pageActive: currentPage == 7 }">7</a>
    <a href="#" id="page" @click="getResults(8)" v-bind:class="{ pageActive: currentPage == 8 }">8</a>
    <a href="#" id="page" @click="getResults(9)" v-bind:class="{ pageActive: currentPage == 9 }">9</a>
    <a href="#" id="page" @click="getResults(10)" v-bind:class="{ pageActive: currentPage == 10 }">10</a>
    <a href="#" id="page" @click="getResults(11)" v-bind:class="{ pageActive: currentPage == 11 }">11</a>
    <a href="#" id="page" @click="getResults(currentPage+1)" v-if="currentPage!=11">Suivant</a>
    <Footer></Footer>
  </div>

</template>

<script>
import Footer from './Footer.vue'
import ListPokemon from './ListPokemon'
import axios from 'axios'

export default {
  name: 'Home',
  components: {
    ListPokemon,
    Footer
  },
  data: function () {
    return {
      pokemonsArray: null,
      currentPage: 1,
      page: 1
    }
  },
  mounted () {
    this.getResults(1)
  },
  methods: {
    getResults (pageAxios) {
      this.currentPage = pageAxios
      axios
        .get('http://127.0.0.1:8000/api/pokemons?page=' + pageAxios)
        .then((response) => {
          this.pokemonsArray = response.data.data
        })
    }
  }
}
</script>

<style scoped>
.pokemon {
  min-height: 70vh;
}

.pageActive {
font-weight: bold;
color: darkred;
border: 1px black solid;
padding: 3px;
}

#page {
  margin-left: 4%;
}

</style>
