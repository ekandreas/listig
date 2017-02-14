<template>
    <nav class="panel">
        <p class="panel-heading">
            {{ list.name }}
            <a class="icon is-pulled-right gear-icon" @click="listEdit(list)">
                <i class="fa fa-gear"></i>
            </a>
            <a class="icon is-pulled-right file-icon" @click="addEmpty(list)">
                <i class="fa fa-file-o"></i>
            </a>
        </p>
        <draggable :class="{ 'panel-block initial-area' : list.posts.length==0 }" :list="list.posts"
                   :options="{group:'posts',animation:350}" @add="added">

            <div class="panel-block draggable-post" @click="postEdit(post)"
                 v-for="(post,index) in list.posts" :class="{ 'is-active': selectedIndex==list.posts.indexOf(post) }">

                <a class="delete is-small" @click="postRemove(post)"></a>&nbsp;&nbsp;
                <span :class="{ 'active-post': selectedIndex==list.posts.indexOf(post) }">{{ post.headline}}</span>

            </div>
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
                selectedIndex: -1,
                dirty: false,
                drag: false,
            }
        },
        created() {
            let self = this;
            window.eventBus.$on('list-dirty', function (listId) {
                if (listId == self.list.id) self.dirty = true;
            });
            window.eventBus.$on('post-selected', function (post) {
                self.selectedIndex = self.list.posts.indexOf(post);
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
            addEmpty() {
                let self = this;
                self.dirty = true;
                let newPost = {
                    id: 0,
                    headline: 'New post item',
                    excerpt: '',
                    url: ''
                };
                self.list.posts.push(newPost);
                window.eventBus.$emit('post-selected', newPost);
                window.eventBus.$emit('post-edit', {listId: self.list.id, post: newPost});
            },
            listEdit(list) {
                window.eventBus.$emit('list-edit', list);
            },
            added(e) {
                let self = this;
                self.dirty = true;

                self.selectedIndex = [e.newIndex];
                window.eventBus.$emit('post-selected', self.list.posts[e.newIndex]);
            },
            postEdit(post) {
                let self = this;
                window.eventBus.$emit('post-selected', post);
                window.eventBus.$emit('post-edit', {listId: self.list.id, post: post});
            },
            postRemove(post) {
                let self = this;
                window.eventBus.$emit('post-selected', null);
                let index = self.list.posts.indexOf(post);
                self.list.posts.splice(index, 1);
                self.dirty = true;
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
            listChanged(e) {
                let self = this;
                self.dirty = true;
                window.eventBus.$emit('post-selected', self.list.posts[e.newIndex]);
            }
        }
    };
</script>

<style>
    .draggable-post:hover {
        cursor: move;
    }

    .file-icon {
        margin-right: 10px;
        color: #999;
    }

    .gear-icon {
        color: #999;
    }

    .initial-area {
        min-height: 40px;
    }

    .active-post {
        font-weight: bolder;
    }
</style>