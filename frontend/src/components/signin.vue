<template>
<main>
<div class="container">
<div class="row">

<h3 class="text-center ml-4">Se connecter</h3>
<hr>

<form style="margin-top: 5px; border: none; z-index:0" class="form-control" action="http://127.0.0.1.8001/api/login" method="post" onsubmit="myFunction()">

<p class="col-md-12 d-block">
<input type="text" class="form-control" v-model="email" name="email" placeholder="Email" required="required">
<span class="text-danger" v-show="errorEmail != ''">{{errorEmail}}</span>
</p>

<p class="col-md-12 d-block">
<input type="password" class="form-control" v-model="password" name="password" placeholder="Mot de passe" required="required">
<span class="text-danger" v-show="errorPassword != ''">{{errorPassword}}</span>
</p>

<div class="col-md-12 d-block mt-5">
<div class="text-center"><a href="#">Mot de passe oublié ?</a></div>
<button type="button" @click="signIn()" name="login" class="btn btn-md btn-primary btn-lg">SE CONNECTER</button><br/>
</div>

</form>

</div>
</div>
<p></p>
<p></p>

</main>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import { EventBus } from '../event-bus.js'

export default Vue.extend({
  data: function () {
    return {
      email: null,
      password: '',
      errorPostedElements: false,
      errorEmail: '',
      errorPassword: '',
      // eslint-disable-next-line
      reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
    }
  },
  mounted () {
    this.email = ''
    this.errorEmail = ''
    this.errorPassword = ''
  },
  methods: {
    signIn () {
      console.log('sign in')
      this.checkPostedElements()
      this.$router.push('/team')
    },
    checkPostedElements () {
      if (this.email == null || this.email === '') {
        this.errorEmail = 'Merci de saisir votre e-mail'
        return false
        // eslint-disable-next-line
      }

      else if (!this.reg.test(this.email)) {
        this.errorEmail = "Merci de vérifier l'adresse e-mail"
        return false
        // eslint-disable-next-line
      }

      else if (this.password.trim() === '') {
        this.errorPassword = 'Le mot de passe ne peut être vide!'
        return false
        // eslint-disable-next-line
      }

      else {
        axios.post('http://127.0.0.1.8001/api/login', {
          email: this.email,
          password: this.password
        })
          .then((response) => {
            const token = response.data.access_token
            var userAuth = {
              userToken: token,
              userEmail: this.email
            }
            EventBus.$emit('userAuth', userAuth)
            this.$router.push('/team')
          })
          .catch(function (error) {
            console.log(error)
          })

        this.errorEmail = ''
        this.errorPassword = ''
        return true
      }
    }
  }
})
/* eslint-disable */
</script>

<style scoped>
  .signup-form {
    display: flex;
  }
  .errorPostedElements {
    border: 1px solid darkred !important;
  }
  .postedElementsOk {
    border: 1px solid #ccc !important;
  }

  button .btn {
    margin-bottom: 5%!important;
  }

  .container {
    display: flex;
    justify-content: center;
    max-width: 25%;
  }
</style>
