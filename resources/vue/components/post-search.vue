<template>
        <nav class="panel">
            <p class="panel-heading">
                Post Search
            </p>
            <div class="panel-block">
                <div class="columns">
                    <div class="column is-4">
                        <div class="control has-icon">
                            <input class="input is-small" type="text" placeholder="Search" @keyup="searchBounce" v-model="form.search">
                            <span class="icon is-small">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="control">
                            <p class="control">
                                <span class="select is-small">
                                    <select v-model="form.author" @change="search">
                                      <option value="0">-- no author --</option>
                                      <option v-for="author in authors" :value="author.data.ID">{{ author.data.display_name }}</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="control">
                            <p class="control">
                                <span class="select is-small">
                                    <select v-model="form.posttype" @change="search">
                                      <option value="0">-- no posttype --</option>
                                      <option v-for="posttype in posttypes" :value="posttype.name">{{ posttype.label }}</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-block" v-for="post in posts" :class="{ 'is-active': post.ID==currentPostId }" @click="currentPostId = post.ID">
                <span v-if="post.ID!=currentPostId">
                    {{ post.post_title }}
                </span>
                <span class="selected-post" v-if="post.ID==currentPostId">
                    {{ post.post_title }}
                </span>
            </div>
            <div class="panel-block">
                <button class="button is-outlined">
                    1
                </button>&nbsp;
                <button class="button is-outlined">
                    2
                </button>&nbsp;
                <button class="button is-outlined">
                    3
                </button>
            </div>
        </nav>
</template>

<script>
    module.exports = {
        mounted: function () {
            let self = this;
            axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
            axios.get(listig.restUrl + '/author')
                .then(function (response) {
                    self.authors = response.data;
                });
            axios.get(listig.restUrl + '/posttype')
                .then(function (response) {
                    self.posttypes = response.data;
                });
            self.search();
        },
        data: function () {
            return {
                currentPostId: 0,
                searchTimer: 0,
                authors: [],
                posttypes: [],
                posts: [],
                form: {
                    author: 0,
                    search: '',
                    posttype: 0
                },
                lang: listig.lang,
            }
        },
        methods: {
            search: function() {
                let self = this;

                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.post(listig.restUrl + '/post-search', self.form)
                    .then(function (response) {
                        self.posts = response.data.posts;
                    });
            },
            searchBounce: function() {
                let self = this;

                clearTimeout(self.searchTimer);
                this.searchTimer = setTimeout(function(){
                    self.search();
                }.bind(this), 300);
            }
        }
    };
</script>

<style>
    .post-label {
        float:right;
    }
    .selected-post {
        color: #333;
        font-weight: bolder;
    }
</style>