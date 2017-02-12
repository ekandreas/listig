<template>
    <nav class="panel">
        <p class="panel-heading">
            {{ list.name }}
            <a class="icon pull-right gear-icon" @click="listEdit(list)">
                <i class="fa fa-gear"></i>
            </a>
        </p>
        <draggable :class="{ 'panel-block initial-area' : list.posts.length==0 }" :list="list.posts"
                   :options="{group:'posts',animation:350}" @start="drag=true" @end="endDrag" @add="added">

            <a class="panel-block"
               v-for="post in list.posts"
               @click="postEdit(post)"
               :class="{ 'is-active': post.id==currentPostId }">
                {{ post.headline}}
            </a>
        </draggable>
        <div class="panel-block" v-if="dirty">
            <div class="control">
                <button class="button is-primary" @click="save">Save</button>
            </div>
        </div>
    </nav>
</template>

<script>
    module.exports = {
        props: ['list'],
        data() {
            return {
                currentPostId: 0,
                dirty: false,
                drag: false,
            }
        },
        created() {
            let self = this;
            window.eventBus.$on('list-dirty', function (listId) {
                if (listId == self.list.id) self.dirty = true;
            });
            $(window).bind('beforeunload', function(e){
                if(self.dirty)
                    return "Unsaved changes in list " + self.list.name;
                else
                    e=null; // i.e; if form state change show warning box, else don't show it.
            });
        },
        mounted() {
            let self = this;
        },
        methods: {
            listEdit(list) {
                window.eventBus.$emit('list-edit', list);
            },
            added(e) {
                let self = this;
                self.dirty = true;

                self.currentPostId = self.list.posts[e.newIndex].id;
            },
            postEdit(post) {
                let self = this;
                self.currentPostId = post.id;
                window.eventBus.$emit('post-edit', {listId: self.list.id, post: post});
            },
            save() {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.post(`${listig.restUrl}/listing/${self.list.id}/posts`, self.list)
                    .then(function (response) {
                        self.dirty = false;
                        window.eventBus.$emit('list-rebound', self.list.id);
                    });
            },
            endDrag() {
                let self = this;
                self.dirty = true;
            }
        }
    };
</script>

<style>
    .gear-icon {
        color: #999;
    }

    .initial-area {
        min-height: 40px;
    }
</style>