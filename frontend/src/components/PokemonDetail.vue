<template>
<body>
  <div id="all">
    <div class="nom"> <h2>{{ pokemon[1] }} </h2></div>
    <!-- <div><img :src="getImgUrl(item.img?item.img:'009')"/></div> -->
    <div class="id"> Numéro : {{ pokemon[0] }}</div>
    <div id="image">
      <img :src="getImgUrl(pokemon[2])"/>
    </div>
    <ul>
      <h3><hr>Types</h3>
      <li class="type" v-for="(type, index) in pokemon[3].type" :key="index">
        {{ type }}
      </li>
      <h3><hr>Stats</h3>
      <li class="stats" v-for="(stats, key, index) in pokemon[4].stats" :key="index">
        {{ key }} : {{ stats }}
      </li>
      <h3><hr>Weaknesses</h3>
      <li class="weaknesses" v-for="(weaknesses, key, index) in pokemon[5].weaknesses" :key="index">
        {{ key }} : {{ weaknesses }}
      </li>
      <hr><h3>Niveaux d'évolution</h3>
      <li class="evolutions" v-for="(evolutions, key, index) in pokemon[6].evolutions" :key="index">
        Niveau d'évolution {{index+1 }} : {{ evolutions }}
      </li>
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
      routeid: this.$route.params.id,
      pokemon: []
    }
  },
  methods: {
    getResults (routeid) {
      axios
        .get('http://127.0.0.1:8000/api/pokemons/' + routeid)
        .then((response) => {
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
div {
    display: flex;
    flex-direction: column;
}

#all {
    border: 1px #DCDCDC solid;
    border-radius: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40%;
    box-shadow: 0px 0px 32px -16px #000000;
    border: 20px solid #FBF2B7;
}

 body {
  display: flex;
  justify-content: center;
}

/*
img {
  width: 70%;
}

.image {
  display: flex;
  justify-content: center;
  align-items: center;
}

.type {
    display: flex;

}

li, .type {
  list-style : square; /* circle
}*/

.type, .stats, .weaknesses, .evolutions {
    background: linear-gradient(45deg, white 50%, #F5F5F5 50%); /* #D3D3D3 50% */
    background-size: 10% 10%;
}

.nom {
  padding: 2%;
  background-size: 5% 5%;
  display: flex;
  align-items: center;
  width: 100%;
}

img {
  width: 80%;
}
@media only screen and (max-width: 992px) {
  img {
    width:50%;
  }

#image {
      display: flex;
    justify-content: center;
    align-items: center;
}

  #all {
    width: 80%;
  }
}
</style>
