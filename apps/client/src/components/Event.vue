<template>
  <li class="list-group-item">
      {{ start }} - {{ end }}<br>
      <strong>{{ summary }}</strong><br>
      <small><em>{{ organizer}}</em></small>
  </li>
</template>

<script>
export default {
  name: 'event',

  props: ['organizer', 'summary', 'start', 'end'],
}
</script>
