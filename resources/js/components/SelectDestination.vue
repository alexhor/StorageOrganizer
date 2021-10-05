<template>
  <span>
    <select v-model.number="selectedType" name="destination_type">
      <option v-for="(description, type) in destinationTypeList" :value="type">
        {{ description }}
      </option>
    </select>

    <span v-for="(idList, type) in destinationIdList">
      <select v-if="selectedType === type" v-model.number="selectedId" name="destination_id">
        <option v-for="(description, id) in idList" :value="id">
          {{ description }}
        </option>
      </select>
    </span>
  </span>
</template>

<script>
export default {
  name: 'SelectDestination',
  props: {
    destinationTypeList: {
      title: 'destinationTypeList',
      type: Array,
      default() { return [] },
    },
    destinationIdList: {
      title: 'destinationIdList',
      type: Array,
      default() { return [] },
    }
  },
  data() {
    return {
      selectedType: -1,
      selectedId: -1,
    }
  }
}
</script>
