<script setup>

import favicon from "@/Layouts/favicon-32x32.png";
</script>

<template>
  <div>
      <Head title="Log in / Sign up">
          <link rel="icon" :href="favicon" />
      </Head>
    <header>
        <slot name="header" />
    </header>
    <main>
      <slot />
    </main>
  </div>
</template>

<style scoped>

</style>
