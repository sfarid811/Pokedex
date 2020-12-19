<template>
<body>
  <div id="all">
    <h1> Interface utilisateur</h1>

    <p>Icônes de profil : </p>
    <img src="../assets/pokemon-icons/pokeball.png" alt="pokeball" height="85vh">
    <img src="../assets/pokemon-icons/pikachu.png" alt="pikachu" height="85vh">
    <img src="../assets/pokemon-icons/charmander.png" alt="charmander" height="85vh">
    <img src="../assets/pokemon-icons/bulbasaur.png" alt="bulbasaur" height="85vh">
    <img src="../assets/pokemon-icons/squirtle.png" alt="squirtle" height="85vh">

    <h3>Pokemon du jour</h3>

          <div class="nom"><h2> {{ pokemon[0][1] }} </h2></div>
          <!-- <div><img :src="getImgUrl(item.img?item.img:'009')"/></div> @click="$router.push('/pokemon/44')-->
          <div class="id" v-if="pokemon[0]"> Numéro : {{ pokemon[0][0] }}</div>
          <div id="image">
            <a @click="$router.push('/pokemon/44')"> <img :src="getImgUrl(pokemon[0][2])"  height="105vh"/></a>
          </div>

          <ul><details>
            <h3><hr>Types</h3>
            <li class="type" v-for="(type, index) in pokemon[0][3].type" :key="index">
              {{ type }}
            </li>
            <h3><hr>Stats</h3>
            <li class="stats" v-for="(stats, key, index) in pokemon[0][4].stats" :key="index">
              {{ key }} : {{ stats }}
            </li>
            <h3><hr>Weaknesses</h3>
            <li class="weaknesses" v-for="(weaknesses, key, index) in pokemon[0][5].weaknesses" :key="index">
              {{ key }} : {{ weaknesses }}
            </li>
            <hr><h3>Niveaux d'évolution</h3>
            <li class="evolutions" v-for="(evolutions, key, index) in pokemon[0][6].evolutions" :key="index">
              Niveau d'évolution {{index+1 }} : {{ evolutions }}
            </li></details>
          </ul>

      <!-- {{ pokemon }} -->
  </div>

</body>
</template>

<script>
import axios from 'axios'

export default {
  data: function () {
    return {
      pokemon: []
    }
  },
  methods: {
    getResults () {
      axios
        .get('http://127.0.0.1:8000/api/users/49/team')
        .then((response) => {
          console.log(response.data)
          this.pokemon = response.data
        })
    },
    getImgUrl (pet) {
      var images = require.context('../assets/pokemon_image/pokemon_image', false, /\.png$/)
      return images('./' + pet + '.png')
    }
  },
  mounted () {
    this.getResults(this.routeid)
  }
}
</script>

<style scoped>
.all {
  display: flex;
  justify-content: center;
}

</style>
