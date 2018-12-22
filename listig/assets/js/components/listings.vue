<template>
    <div>
        <list-item v-for="list in lists" :id="list" :key="list"></list-item>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                lists: []
            }
        },
        created() {
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
        mounted() {
            let self = this;
            self.getAll();
        },
        methods: {
            getAll() {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.get(listig.restUrl + '/listing')
                    .then(function (response) {
                        response.data.forEach(function(list) {
                            self.lists.push(list.id);
                        });
                    });
            },
            getSingle(listId) {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.get(`${listig.restUrl}/listing/${listId}`)
                    .then(function (response) {

                        let index = self.lists.indexOf(listId);

                        if(index<0) {
                            self.lists.unshift(response.data.id);
                            return;
                        }

                        if(!response.data) {
                            self.lists.splice(index,1);
                            return;
                        }

                        self.lists[index] = response.data;
                    });
            }
        }
    };
</script>

<style>
    .gear-icon {
        color: #999;
    }
</style>