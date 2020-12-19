<template>
<div>
    <div id="ligne_haut" class="d-none d-lg-flex d-xl-flex">

        <a href="/#"><img src="./assets/pokemon-logo.png" id="logo"></a>
        <div>
          <div id="compte">
            <router-link v-show="authenticated == 'false'" :to="{ name: 'signup' }" class="navbar-brand">S'inscrire</router-link>
            <router-link v-show="authenticated == 'false'" :to="{ name: 'signin' }" class="navbar-brand">Se connecter</router-link>
            <div class="row text-center navbar-brand" v-show="authenticated == 'true'">
              <i class="fa fa-user"></i> Connecté en tant que : {{ emailUserConnected }}
              <a href="#" @click="logout()" >Déconnexion</a>
            </div>

          </div>

            <div style="position: absolute; z-index: 9999">
              <input v-on:keyup="search($event.target.value)" v-model="word" type="search" class="form-control" name="search" id="search_bar" placeholder="recherche">
                <ul v-if="results.length > 0" class="list-group">
                  <li v-for="result in results" :key="result.id" class="list-group-item">
                    <a :href="'/pokemon/'+result.id">{{result.title}}</a>
                  </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="ligne_haut_mobile" class="d-lg-none d-xl-none">
        <div>
          <form action="search.php" method="GET">
            <input type="search" name="search" id="search_bar_mobile" placeholder="recherche">
            <input type="hidden" name="sort" value="1">
            <input type="hidden" id="search_img_mobile">
          </form>
        </div>
      </div>

  <div id="app">
<transition name="pok_anim" mode="out-in">
 <router-view/>
 </transition>
  </div>

</div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { EventBus } from './event-bus.js'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
/* eslint-disable-next-line */
export default {
  name: 'App',
  data: function () {
    return {
      authenticated: '',
      emailUserConnected: '',
      results: [],
      word: ''
    }
  },
  mounted () {
    this.isAuthenticated()
  },
  methods: {
    isAuthenticated () {
      if (localStorage.getItem('userToken') && localStorage.getItem('userEmail')) {
        var userToken = localStorage.getItem('userToken')
        var userEmail = localStorage.getItem('userEmail')

        const config = {
          headers: { Authorization: `Bearer ${userToken}` }
        }

        const bodyParameters = {
          userToken: userToken,
          userEmail: userEmail
        }

        axios.post(
          'http://127.0.0.1:8000/api/checkToken',
          bodyParameters,
          config
        )
          .then((response) => {
            const validation = response.data.validation

            if (validation) {
              this.authenticated = 'true'
              this.emailUserConnected = localStorage.getItem('userEmail')
            } else {
              this.authenticated = 'false'
              this.emailUserConnected = ''
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      } else {
        this.authenticated = 'false'
        this.emailUserConnected = ''
        EventBus.$off('userAuth')
        EventBus.$on('userAuth', userAuth => {
          localStorage.setItem('userToken', userAuth.userToken) // store the token in localstorage
          localStorage.setItem('userEmail', userAuth.userEmail)
          this.authenticated = 'true'
          this.emailUserConnected = localStorage.getItem('userEmail')
        })
      }
    },
    logout () {
      this.authenticated = 'false'
      localStorage.removeItem('userToken')
      localStorage.removeItem('userEmail')

      this.$router.push('/signin')
    },
    search (typed) {
      this.results = []
      if (typed.length >= 2) {
        // eslint-disable-next-line
        const pokObject = {
          'pok': typed
        }
        console.log(typed)
        axios.get('http://127.0.0.1:8000/api/pokemon/search?pok=' + typed)
          .then((response) => {
            console.error(response.data)
            response.data.forEach(element => {
              let res = {
                id: element[0],
                title: element[1],
                url: 'pokemon/' + element[0]
              }
              this.results.push(res)
            })
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    }
  }
}
/* eslint-disable */
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

a {
  color: #1f1400;
}

.footer {
  position: absolute; bottom: 0;
}

.intermediaire_div{
  padding-bottom: 0.5em;
  padding-top: 0.5em;
}
.intermediaire_div:hover{
  transform: scale(1.1);
  transition: 0.2s;
  box-shadow: 1px 1px 15px #d5e3d9;
}

a:hover {
  color: #1f1400;
  text-decoration: none;
  font-weight: bold;
}

nav ul {
  list-style-type: none;
  display: flex;
  justify-content: space-around;
  width:75vw;
  margin: 5vh auto 3vh auto;
  font-size: 1.2em;
}

.navbar-brand {
  margin-bottom: 15%;
}

.sous-menus {
  position: absolute;
  background-color: #d5e3d9;
  width: 150px;
  display: none;
  padding-left: 5px;
  z-index: 150;
}

.menu-item:hover .sous-menus {
  display: block;
}

.sous-menus a{
  display: block;
}

header,footer {
  z-index: 150;
}

header #logo {
  width: 10vw;
}

#ligne_haut > div {
  width: 25vw;
}

header #ligne_haut {
  display: flex;
  justify-content: space-between;
  padding: 2vh 4vw 2vw 40vw;
}

form #search_img {
  width: 9%;
  margin-left: 15px;
}

header #compte {
  display: flex;
  justify-content: space-around;
  align-items: center;
}

header form {
  display: flex;
  align-items: center;
  margin-top: 13%;
  justify-content: flex-end;
}

form #search_bar,#search_bar_mobile {
  height: 2.3em;
  width: 20em;
  background-color: rgba(201, 76, 76, 0);
  font-family: "Montserrat", sans-serif;
  font-size: 1.7;
  color: #3f2a2e;
  text-transform: uppercase;
  border: 0;
  border: 1px solid #3f2a2e;
  padding: 0 7px;
  border-radius: 25px;
}

#search_bar:focus {
        outline: none;
}

@media only screen and (max-width: 992px) {
  #search_img_mobile {
    width: 9%;
    margin-left: 2%;
    margin-right: 12%;
  }

  #search_bar_mobile {
    width: 62%;
    margin-right: 20%;

  }

  #logo_mobile {
    display: flex!important;
    justify-content: center!important;
    align-items: center!important;
    margin-right: 0;
  }

}

.pok_anim-enter-active,
.pok_anim-leave-to{
transition:all 0.5s;
}
.pok_anim-enter,
.pok_anim-leave-active{
 opacity: 0;
 transform: translateX(-10%);
}
</style>
