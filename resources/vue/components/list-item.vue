<template>
        <nav class="panel">
            <p class="panel-heading">
                {{ list.name }}
                <a class="icon pull-right gear-icon" @click="edit(list)">
                    <i class="fa fa-gear"></i>
                </a>
            </p>
            <draggable :list="posts"
                       :options="{group:'posts',animation:350}" @start="drag=true" @add="added">
                <a class="panel-block" v-for="post in posts" :list="posts" :class="{ 'is-active': post.ID==currentPostId }">
                    {{ post.post_title}}
                </a>
            </draggable>
            <div class="panel-block" v-if="dirty">
                <div class="control">
                    <button class="button is-primary is-outlined is-fullwidth">Save</button>
                </div>
            </div>
        </nav>
</template>

<script>
    module.exports = {
        props: ['list'],
        data: function () {
            return {
                currentPostId: 0,
                posts: [
                    {ID:0,post_title:'{ Empty! Drag a post here... }'}
                ],
                dirty: false
            }
        },
        created: function () {
            let self = this;
        },
        mounted: function () {
            let self = this;
        },
        methods: {
            edit: function (list) {
                window.eventBus.$emit('list-edit', list);
            },
            added: function(e) {
                let self = this;
                self.dirty=true;

                self.currentPostId = self.posts[e.newIndex].ID;

                for(let i = 0; i < self.posts.length; i++) {
                    if(self.posts[i].ID == 0) {
                        self.posts.splice(i, 1);
                        break;
                    }
                }

            }
        }
    };
</script>

<style>
    .gear-icon {
        color: #999;
    }
</style>