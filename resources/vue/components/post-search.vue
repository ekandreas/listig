<template>
    <nav class="panel">
        <p class="panel-heading">
            {{ lang.postSearchLabel }}
        </p>
        <div class="panel-block">
            <div class="columns">
                <div class="column is-4">
                    <div class="control has-icon">
                        <input class="input is-small" type="text" :placeholder="lang.searchPlaceholder" @keyup="searchBounce"
                               v-model="form.search">
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
                                      <option value="0">-- {{ lang.noAuthorLabel }} --</option>
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
                                      <option value="0">-- {{ lang.noPosttypeLabel }} --</option>
                                      <option v-for="posttype in posttypes"
                                              :value="posttype.name">{{ posttype.label }}</option>
                                    </select>
                                </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <draggable class="draggable-container" :list="posts"
                   :options="{ group:'posts', animation:350, pull:'clone', put:false }">

            <div class="panel-block draggable-post" v-for="post in posts" :class="{ 'is-active': post.id==currentPostId }" :key="post.id"
                 @click="currentPostId = post.id">
                <span class="{ 'selected-post' : post.id==currentPost}">
                    {{ post.headline }}
                </span>
            </div>

        </draggable>

        <div class="panel-block">

            <a class="button button-page-previous is-outlined is-small" v-if="form.page > 1" @click="previous">
                    <span class="icon is-small">
                        <i class="fa fa-angle-left"></i>
                    </span>
                {{ lang.previousLabel }}
            </a>&nbsp;

            <span class="tag is-primary">{{ form.page }} / {{ maxPages }}</span>&nbsp;

            <a class="button button-page-next is-outlined is-small" v-if="form.page<maxPages" @click="next">
                {{ lang.nextLabel }}
                <span class="icon is-small">
                        <i class="fa fa-angle-right"></i>
                    </span>
            </a>&nbsp;

            <p class="control">
                    <span class="select is-small pull-right">
                        <select v-model="form.postsPerPage" @change="changePostsPerPage">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="100">100</option>
                        </select>
                    </span>
            </p>

        </div>
    </nav>
</template>

<script>
    export default {

        mounted() {
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
        data() {
            return {
                currentPostId: 0,
                searchTimer: 0,
                authors: [],
                posttypes: [],
                posts: [],
                maxPages: 1,
                form: {
                    page: 1,
                    author: 0,
                    search: '',
                    posttype: 0,
                    postsPerPage: listig.userSettings[0] ? parseInt(listig.userSettings[0].searchPostsPerPage) : 10
                },
                lang: listig.lang
            }
        },
        methods: {
            search(noReset) {
                let self = this;
                self.form.page = 1;
                self.maxPages = 1;
                self.queryForm();
            },
            queryForm() {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.post(listig.restUrl + '/post-search', self.form)
                    .then(function (response) {
                        self.posts = response.data.posts;
                        self.maxPages = response.data.query.max_num_pages;
                        self.form.page = response.data.query.query.paged;
                    });
            },
            searchBounce() {
                let self = this;

                clearTimeout(self.searchTimer);
                this.searchTimer = setTimeout(function () {
                    self.search();
                }.bind(this), 300);
            },
            changePostsPerPage() {
                let self = this;

                let fields = [
                    {
                        'searchPostsPerPage': self.form.postsPerPage
                    }
                ];
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.post(listig.restUrl + '/user-setting', fields)
                    .then(function (response) {
                        self.search();
                    });
            },
            next() {
                let self = this;
                self.form.page++;
                self.queryForm();
            },
            previous() {
                let self = this;
                self.form.page--;
                self.queryForm();
            }
        }
    };
</script>

<style>
    .draggable-container {
        min-height: 20px;
    }

    .draggable-post:hover {
        cursor: move;
    }

    .post-label {
        float: right;
    }

    .selected-post {
        color: #333;
        font-weight: bolder;
    }

    .button-page-next span i {
        margin-top: 5px;
        margin-left: 10px;
    }

    .button-page-previous span i {
        margin-top: 5px;
        margin-right: 10px;
    }
</style>