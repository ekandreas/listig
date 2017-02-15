<template>
    <nav class="panel" v-if="id>0">
        <p class="panel-heading">
            {{ name }}&nbsp;
            <a class="icon is-pulled-right gear-icon" @click="listEdit">
                <i class="fa fa-gear"></i>
            </a>
            <a class="icon is-pulled-right file-icon" @click="addEmpty">
                <i class="fa fa-file-o"></i>
            </a>
        </p>
        <draggable :class="{ 'panel-block initial-area' : posts.length==0 }" :list="posts"
                   :options="{group:'posts',animation:350}" @add="dragAdded" @end="dragEnded">

            <div class="panel-block draggable-post" @click="postEdit(post)"
                 v-for="(post,index) in posts" :class="{ 'is-active': selectedIndex==posts.indexOf(post) }">

                <a class="delete is-small" @click="postRemove(post)"></a>&nbsp;&nbsp;
                <span :class="{ 'active-post': selectedIndex==posts.indexOf(post) }">{{ post.headline}}</span>

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
        props: ['id'],
        data() {
            return {
                name: '',
                posts: [],
                selectedIndex: -1,
                dirty: false,
                drag: false,
            }
        },
        created() {
            let self = this;
            window.eventBus.$on('list-dirty', function (listId) {
                if (listId == self.id) self.dirty = true;
            });
            window.eventBus.$on('post-selected', function (post) {
                self.selectedIndex = self.posts.indexOf(post);
            });
            $(window).bind('beforeunload', function (e) {
                if (self.dirty)
                    return "Unsaved changes in list " + self.name;
                else
                    e = null; // i.e; if form state change show warning box, else don't show it.
            });
        },
        mounted() {
            let self = this;
            axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
            axios.get(`${listig.restUrl}/listing/${self.id}`)
                .then(function (response) {
                    self.dirty = false;
                    self.name = response.data.name;
                    self.posts = response.data.posts;
                });
        },
        methods: {
            focusOnPost(post) {
                let self = this;
                window.eventBus.$emit('post-selected', post);
                window.eventBus.$emit('post-edit', {listId: self.id, post: post});
            },
            addEmpty() {
                let self = this;
                self.dirty = true;
                let newPost = {
                    headline: 'New post item'
                };
                self.posts.push(newPost);
                self.focusOnPost(newPost);
            },
            listEdit() {
                let self = this;
                window.eventBus.$emit('list-edit', self.id);
            },
            dragAdded(e) {
                let self = this;
                self.dirty = true;
                self.focusOnPost(self.posts[e.newIndex]);
            },
            postEdit(post) {
                let self = this;
                self.focusOnPost(post);
            },
            postRemove(post) {
                let self = this;
                window.eventBus.$emit('post-selected', null);
                let index = self.posts.indexOf(post);
                self.posts.splice(index, 1);
                self.dirty = true;
            },
            save() {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.post(`${listig.restUrl}/listing/${self.id}/posts`, self.posts)
                    .then(function (response) {
                        self.dirty = false;
                        //window.eventBus.$emit('list-rebound', self.id);
                    });
            },
            dragEnded(e) {
                let self = this;
                self.dirty = true;
                self.focusOnPost(self.posts[e.newIndex]);
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