<template>
    <div v-if="post">
        <div class="box">
            <h2 class="title is-2">{{ post.headline }}</h2>
            <article class="media">
                <div class="media-left" v-if="post.imageUrl">
                    <figure class="image is-64x64">
                        <img :src="post.imageUrl" alt="Image"/>
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content" v-html="post.excerpt"></div>
                </div>
            </article>
        </div>
        <div class="panel">
            <p class="panel-heading">
                {{ lang.postEditLabel }}
            </p>
            <div class="panel-block">
                <div class="control">
                    <input class="input"
                           type="text"
                           :placeholder="lang.headlineLabel"
                           v-on:keyup="changed(post)"
                           v-model="post.headline"/>
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <textarea class="textarea"
                              :placeholder="lang.excerptLabel"
                              v-on:keyup="changed(post)"
                              v-model="post.excerpt"></textarea>
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <input class="input"
                           type="text"
                           :placeholder="lang.urlLabel"
                           v-on:keyup="changed(post)"
                           v-model="post.url"/>
                </div>
            </div>
            <div class="panel-block">
                <div class="control">
                    <button class="button" @click="changeImage">
                        <span v-if="post.imageUrl">
                            {{ lang.changeImageLabel }}
                        </span>
                        <span v-if="!post.imageUrl">
                            {{ lang.addImageLabel }}
                        </span>
                    </button>
                    <button class="button" @click="removeImage" v-if="post.imageUrl">
                        {{ lang.removeImageLabel }}
                    </button>
                </div>
            </div>
            <div class="panel-block" v-if="dirty">
                <div class="control">
                    <button class="button is-primary">{{ lang.saveLabel }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                dirty: false,
                currentListId: 0,
                post: {},
                file_frame: null,
                lang: listig.lang
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

                if (self.file_frame) {
                    self.file_frame.open();
                    return;
                }

                self.file_frame = wp.media.frames.file_frame = wp.media({
                    title: self.post.name,
                    button: {
                        text: self.lang.selectAttachmentLabel,
                    },
                    multiple: false
                });

                self.file_frame.on('select', function () {
                    let imageId = self.file_frame.state().get('selection').first().id;
                    axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                    axios.get(`${listig.restUrl}/helper/attachment/url/${imageId}`)
                        .then(function (response) {
                            self.post.imageId = imageId;
                            self.post.imageUrl = response.data;
                        });
                    window.eventBus.$emit('list-dirty', self.currentListId);
                });

                self.file_frame.open();
            },
            removeImage() {
                let self = this;
                self.post.imageId = 0;
                self.post.imageUrl = '';
                window.eventBus.$emit('list-dirty', self.currentListId);
            }

        }
    };
</script>

<style>

</style>