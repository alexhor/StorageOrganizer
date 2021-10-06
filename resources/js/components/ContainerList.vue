<template>
  <div>
    <div class="search-container">
			<span class="search">
        <i class="fas fa-search" />
				<input v-model="containerSearchInput"
					:placeholder="text.addContainer"
					type="search"
          class="search"
					@keyup="searchContainers">
				<span class="abort fas fa-times-circle" @click="abortSearch" />
			</span>
			<div class="search-suggestion-container">
				<div v-for="container in addContainerSearchSuggestions"
					:key="container.id"
					class="suggestion"
					@click="addContainer(container.id)">
					{{ container.title }}
				</div>
			</div>
		</div>
		<div class="item-list-container">
			<span v-for="container in containerList" :key="container.id" class="item">
				<span class="name">{{ container.title }}</span>
				<span class="remove" @click="removeContainer(container.id)">X</span>
			</span>
			<b v-if="containerList.length < 1">{{ text.noContainersAdded }}</b>
		</div>
  </div>
</template>

<script>
export default {
  name: 'ContainerList',
  props: {
    packlistId: {
      title: 'packlistId',
      type: Number,
      default() { return -1 },// TODO: adjust requests to work without an existing packlist
    }
  },
  data() {
    return {
      text: {
        addContainer: 'Add Container',
        noContainersAdded: 'No containers added',
      },
      containerSearchInput: '',
      containerList: [],
      addContainerSearchSuggestions: [],
    }
  },
  beforeMount() {
    jQuery.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
      }
    });
    this.loadAddedContainers()
  },
  methods: {
    loadAddedContainers() {
      const self = this
      const url = route('packlist.get.container', {packlist: self.packlistId})

      jQuery.get({
        url: url,
        success: function(result) {
          self.containerList = result
        },
        error: function(result) {
          console.debug('ERROR')
          console.debug(result)
        }
      })
    },
    searchContainers() {
      const self = this
      const url = route('packlist.search.container', {packlist: self.packlistId, searchString: self.containerSearchInput})

      if ('' == self.containerSearchInput.trim()) {
        self.addContainerSearchSuggestions = []
        jQuery(".search input[type='search']").removeClass('searching')
        return
      }
      jQuery(".search input[type='search']").addClass('searching')

      jQuery.get({
        url: url,
        success: function(result) {
          self.addContainerSearchSuggestions = result
        },
        error: function(result) {
          console.debug('ERROR')
          console.debug(result)
        }
      })
    },
    abortSearch() {
      this.containerSearchInput = ''
			this.searchContainers()
    },
    addContainer(containerId) {
      const self = this
      const url = route('packlist.add.container', {packlist: self.packlistId, container: containerId})

      jQuery.post({
        url: url,
        success: function(result) {
          self.loadAddedContainers()
          self.searchContainers()
        },
        error: function(result) {
          console.debug('ERROR')
          console.debug(result)
        }
      })
    },
    removeContainer(containerId) {
      const self = this
      const url = route('packlist.delete.container', {packlist: self.packlistId, container: containerId})

      jQuery.ajax({
        url: url,
        type: 'DELETE',
        success: function(result) {
          self.loadAddedContainers()
          self.searchContainers()
        },
        error: function(result) {
          console.debug('ERROR')
          console.debug(result)
        }
      })
    }
  }
}
</script>
