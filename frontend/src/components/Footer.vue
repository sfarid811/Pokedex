<template>
    <div class="text-center" style="width:100%">
    <!-- <img src="../assets/001.png" width="10%"/> -->
    <a href="#">Qui sommes-nous?</a>
    <a href="#">Service client</a>
    <a href="#">Conditions d'utilisation</a>
    <a href="#">Plan du site</a>

    </div>
</template>

<script>

export default {
  data () {
    return {
      name: 'Footer'
    }
  }
}

</script>

<style scoped>
div {
  padding: 2% 0;
  margin-top: 5%;
}

a {
  display: flex;
  justify-content: space-around;
}


</style>
