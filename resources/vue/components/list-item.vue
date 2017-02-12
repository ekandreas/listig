<template>
        <nav class="panel">
            <p class="panel-heading">
                {{ list.name }}
                <a class="icon pull-right gear-icon" @click="listEdit(list)">
                    <i class="fa fa-gear"></i>
                </a>
            </p>
            <draggable :class="{ 'panel-block initial-area' : posts.length==0 }" :list="posts"
                       :options="{group:'posts',animation:350}" @start="drag=true" @add="added">

                <a class="panel-block"
                   v-for="post in posts"
                   :list="posts"
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
                posts: [],
                dirty: false
            }
        },
        created() {
            let self = this;
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
                self.dirty=true;

                self.currentPostId = self.posts[e.newIndex].id;
            },
            postEdit(post) {
                let self = this;
                self.currentPostId = post.id;
                window.eventBus.$emit('post-edit', post);
            },
            save() {
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