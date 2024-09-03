<script setup lang="ts">
</script>

<template>
  <v-container tag="main" class="pa-0 w-100 h-screen" fluid>
    <v-row no-gutters align="center" justify="center" class="h-100 w-100 p-0">
      <v-col sm="10" lg="6" class="h-100 d-flex flex-column justify-center align-center">
        <img src="@/assets/truck.png" alt="Truck Image" class="login-image" />
        <router-view></router-view>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.login-image {
  max-width: 50%;
  height: 20%;
}
</style>
