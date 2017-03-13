<template>
  <div class="room">
    <h1 v-bind:class="{free:free, busy:busy}">{{ room.title }}</h1>
    <h3>Next Events</h3>
    <ul class="list-group">
      <li class="list-group-item" v-for="event in room.events" >
          {{ event.start }} - {{ event.end }}<br>
          <strong>{{ event.summary }}</strong><br>
          <small><em>{{ event.organizer}}</em></small>
      </li>
    </ul>


  </div>
</template>

<script>
export default {
  name: 'room',

  props: ['room'],

  data () {
    return {
    }
  },

  computed: {
    free() {
        return true;
    },
    busy() {
        return false;
    }
  },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
.free {
    background: #d4f2f4;
}
.busy {
    background: #f77493;
}
</style>
