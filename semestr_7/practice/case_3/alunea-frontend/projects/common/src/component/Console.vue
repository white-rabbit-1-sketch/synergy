<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import log from "loglevel";

const expanded = ref(false);
const logs = ref([]);

function toggle() {
  expanded.value = !expanded.value;
}

function addLog(level, intro, style, args) {
  logs.value.push({ level, intro, style, args });
  if (logs.value.length > 200) {
    logs.value.shift();
  }
}

onMounted(() => {
  log.subscribe(addLog);
});

onUnmounted(() => {

});
</script>

<template>
  <div class="log-viewer">
    <v-btn
        size="large"
        class="text-none toggle-btn"
        color="accent"
        variant="outlined"
        @click="toggle"
        block
    >{{ expanded ? "-Console" : "+Console" }}</v-btn>

    <div v-if="expanded" class="logs-container">
      <div
          v-for="(entry, index) in logs"
          :key="index"
          class="log-entry"
      >
        <span v-html="entry.intro" :style="entry.style"></span>
        <span v-for="(arg, i) in entry.args" :key="i" class="log-arg">
          {{ typeof arg === 'object' ? JSON.stringify(arg) : String(arg) }}
        </span>
      </div>
    </div>
  </div>
</template>

<style scoped>
.log-viewer {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 100vw;
  max-width: 100vw;
  max-height: 50vh;
  font-family: monospace;
  font-size: 12px;
  z-index: 9999;
}

.logs-container {
  border: solid 1px white;
  background: #111;
  color: #eee;
  overflow-y: scroll;
  width: 100vw;
  height: calc(50vh - 60px);
  max-height: calc(50vh - 60px);
  word-break: break-all;
  padding: 8px;
}

.toggle-btn {
  height: 60px;
  padding: 6px 12px;
  cursor: pointer;
  width: 100%;
  text-align: left;
  background-color: #000;
}

.log-entry {
  margin-bottom: 4px;
}

.log-arg {
  margin-left: 4px;
}
</style>
