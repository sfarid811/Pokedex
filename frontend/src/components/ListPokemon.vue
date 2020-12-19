<template>
    <div class="box">
        <table>
            <tr class="list" v-for="(item, index) in pokemonsArray" :key="index">
              <router-link :to="'pokemon/'+item.id_pok">
              <td class="idpok"> Numéro : {{ item.id_pok }}</td>
                <td class="nom"><h2>{{ item.nom_pok }}</h2></td>
                <td class="img"><img :src="getImgUrl(item.img?item.img:'009')"/></td>
                <!--<td class="img"><img :src="'../assets/pokemon_image/pokemon_image' +(index > 9?index:'00'+index+'.png')" width="70vw"/></td>-->
                <td class="typess">
                    <ul class="types">
                        <li class="type" v-for="(type, index) in item.type" :key="index">{{ type }}</li>
                    </ul>
                    <button class="show">See more</button>
                </td>
              </router-link>
            </tr>
        </table>
    </div>
</template>

<script>
import Vue from 'vue'
Vue.component('pagination', require('laravel-vue-pagination'))
/* {
           "id_pok": 1,
            "nom_pok": "Bulbizarre",
            "img": null,
            "Description": null,
            "type": {
                "type1": "grass",
                "type2": "poison"
            }
        }, */
export default {
  props: {
    pokemonsArray: {
      type: Array
    },
    pageActuelle: {
      type: Number
    }
  },
  methods: {
    getImgUrl (pet) {
      var images = require.context('../assets/pokemon_image/pokemon_image', false, /\.png$/)
      return images('./' + pet + '.png')
    }
  }
}
</script>

<style scoped>
header {
  background-color: #c8200c;
}
.box table {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding-left: 0;
}

.box table ul li {
    list-style : none;
}

.list {
    display: flex;
    flex-direction: column;
    min-width : 30%;
    border: 1px #DCDCDC solid;
    margin: 0.5%;
    border-radius: 25px;
}

.idpok, .nom, .img, .types{
    display: flex;
    justify-content: center;
    align-items: center;
}

img {
  width: 40%;
}

.img {
  background: #F5F5F5;
}

.type {
  margin-right: 30%;
  padding: 3% 6%;
}

.types {
  border: none;
}
.typess {
  display: flex;
  justify-content: center;
}

button {
  margin-left: 40%;
  height: 2%;
  background: #FBF2B7;
  border-radius: 25px;
}

button:hover {
  background: white;
  font-weight: bold;
}

td {
  background-color: white;
}

a {
  border-radius: 25px;
}

@media only screen and (max-width: 992px) {
  button {
    height: 1%;
    margin-left: 20%;
  }
}
</style>
