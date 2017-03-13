<template>
  <div id="app">
    <room :room="room"></room>

    <div v-if="loading">
        <em>Loading...</em>
        <div class="progress media-content">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                <span class="sr-only">100% Loading</span>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Room from './components/Room.vue'

export default {
  name: 'app',

  components: {
    Room
  },

  data () {
    return {
      loading: false,
      room: {
        title: 'Room #1',
        clientId: null,
        events: []
      }
    }
  },

  watch: {
    room: {
        handler: function(val) {
            if (val && val.events.length > 0) {
                this.checkIsCurrent(val.events[0].start);
            }
        },
        deep: true
    }
  },

  computed: {
    apiUrl() {
        return '/api.php?client=' + this.room.clientId;
    },
  },

  methods: {
    loadData(init) {
        console.log('Start update');

        if(init) this.loading = true;
        this.$http.get(this.apiUrl)
            .then((response) => {
                if(! response.data.success) {
                    console.error(response.data.error);
                }
                this.room.events = response.data.events;
                this.loading = false;
                //window.setTimeout(this.loadData, (2 * 60 * 1000));
            })
            .catch((e) => console.error(e));
    },
    checkIsCurrent(dtBeginString, dtEndString) {
        let now = new Date();
        let dtStart = new Date(dtBeginString);
        let dtEnd = new Date(dtEndString);
        let r =  window.moment.range(dtStart, dtEnd);
        console.log(r.contains(now));
        debugger;
    }
  },

  mounted() {
    this.room.clientId = this.$parent.clientId;
    this.loadData(true);
  }
}
</script>

<style>
body {
  background: #f7f7f4;
  color: #333;
}
h1 {
    font-size: 25px;
    margin-top: 0px;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  padding: 10px;
  font-size: 0.85em;
}
.progress {
    margin-top: 30px;
}
</style>
