<template>
    <draggable :list="listings"
               :options="{group:'listings',animation:350}" @start="drag=true" @end="drag=false">
        <list-item v-for="list in listings" :list="list" :key="list.id"></list-item>
    </draggable>
</template>

<script>

    module.exports = {
        data: function () {
            return {
                listings: []
            }
        },
        created: function () {
            let self = this;
            window.eventBus.$on('list-rebound', function (listId) {
                if (listId) {
                    self.getSingle(listId);
                }
                else {
                    self.getAll();
                }
            });
        },
        mounted: function () {
            let self = this;
            self.getAll();
        },
        methods: {
            getAll() {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.get(listig.restUrl + '/listing')
                    .then(function (response) {
                        if(self.listings.length) {
                            response.data.forEach(function (currentList, index) {
                                if (self.listIndex(currentList.id)<0) {
                                    self.listings.unshift(currentList);
                                }
                            });
                        }
                        else {
                            self.listings = response.data;
                        }
                    });
            },
            getSingle(listId) {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.get(`${listig.restUrl}/listing/${listId}`)
                    .then(function (response) {
                        let position = self.listIndex(listId);
                        if(response.data==null) {
                            self.listings.splice(position,1);
                        }
                        else if(position<0) {
                            self.listings.unshift(response.data);
                        }
                        else {
                            self.listings[position] = response.data;
                        }
                    });
            },
            listIndex(listId) {
                let self = this;
                for(let i=0;i<self.listings.length;i++) {
                    if (self.listings[i].id == listId) {
                        return i;
                    }
                }
                return -1;
            },
            edit(list) {
                window.eventBus.$emit('list-edit', list);
            }
        }
    };
</script>

<style>
    .gear-icon {
        color: #999;
    }
</style>