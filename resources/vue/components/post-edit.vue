<template>
    <div>
        <div class="box">
            <p><strong>{{ post.headline }}</strong></p>
            <br/>
            <article class="media">
                <div class="media-left">
                    <figure class="image is-64x64">
                        <img src="http://bulma.io/images/placeholders/128x128.png" alt="Image">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        {{ post.body }}
                    </div>
                </div>
            </article>
        </div>
        <div class="panel">
            <p class="panel-heading">
                Post Edit
            </p>
            <div class="panel-block">
                <div class="control">
                    <input class="input" type="text" placeholder="Headline" v-model="post.headline">
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <textarea class="textarea" placeholder="Body" v-model="post.body"></textarea>
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <input class="input" type="text" placeholder="Url" v-model="post.url">
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <input class="input" type="text" placeholder="Source">
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <input class="input" type="text" placeholder="Tags">
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <input class="input" type="text" placeholder="Image">
                </div>
            </div>
            <div class="panel-block" v-if="dirty">
                <div class="control">
                    <button class="button is-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data() {
            return {
                dirty: false,
                post: []
            }
        },
        created() {
            let self = this;
            window.eventBus.$on('post-edit', function (post) {
                self.edit(post)
            });
        },
        methods: {
            edit(post) {
                let self = this;

                self.post = post;
            }
        }
    };
</script>

<style>

</style>