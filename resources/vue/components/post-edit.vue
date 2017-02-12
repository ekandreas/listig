<template>
    <div v-if="post.id">
        <div class="box">
            <h2 class="title is-2">{{ post.headline }}</h2>
            <article class="media">
                <div class="media-left">
                    <figure class="image is-64x64">
                        <img :src="post.image" alt="Image" v-if="post.image"/>
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content" v-html="post.excerpt"></div>
                </div>
            </article>
        </div>
        <div class="panel">
            <p class="panel-heading">
                Post Edit
            </p>
            <div class="panel-block">
                <div class="control">
                    <input class="input"
                           type="text"
                           placeholder="Headline"
                           v-on:keyup="changed(post)"
                           v-model="post.headline"/>
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <textarea class="textarea"
                              placeholder="Body"
                              v-on:keyup="changed(post)"
                              v-model="post.excerpt"></textarea>
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <input class="input" type="text" placeholder="Thumbnail, click here to change..." v-model="post.image"
                           v-on:keyup="changed(post)"
                           v-on:change="changed(post)"
                           v-on:click="changeImage"/>
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
                currentListId: 0,
                post: [],
                file_frame: null,
                wp_media_post_id: 0,
            }
        },
        created() {
            let self = this;
            window.eventBus.$on('post-edit', function (data) {
                self.currentListId = data.listId;
                self.edit(data.post)
            });
        },
        methods: {
            edit(post) {
                let self = this;

                self.post = post;
            },
            changed(post) {
                let self = this;
                window.eventBus.$emit('list-dirty', self.currentListId);
            },
            changeImage() {
                let self = this;

                self.wp_media_post_id = wp.media.model.settings.post.id;
                if (self.file_frame) {
                    self.file_frame.uploader.uploader.param('post_id', self.post.id);
                    self.file_frame.open();
                    return;
                } else {
                    wp.media.model.settings.post.id = self.post.id;
                }

                self.file_frame = wp.media.frames.file_frame = wp.media({
                    title: jQuery(this).data('uploader_title'),
                    button: {
                        text: jQuery(this).data('uploader_button_text'),
                    },
                    multiple: false
                });

                self.file_frame.on('select', function () {
                    attachment = self.file_frame.state().get('selection').first().toJSON();
                    self.post.image = attachment.url;
                    window.eventBus.$emit('list-dirty', self.currentListId);
                    wp.media.model.settings.post.id = self.wp_media_post_id;
                });

                self.file_frame.open();
            }

        }
    };
</script>

<style>

</style>