<script setup lang="ts">
defineProps<{ name: string }>();
</script>

<template>
  <v-icon>{{ name }}</v-icon>
</template>
