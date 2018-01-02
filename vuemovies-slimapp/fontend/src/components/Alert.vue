<template>
<div class="alert alert-info container" role="alert">
  {{message}}
</div>
</template>

<script>
export default {
  name: 'alert',
  props: ['message'],
  data () {
    return {


    }
  }
}
</script>
<style scoped></style>

