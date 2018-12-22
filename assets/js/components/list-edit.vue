<template>
    <div :class="moduleClass">
        <div class="modal-background" @click="close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ lang.editLabel }} {{ form.id }}</p>
                <button class="delete" @click="close"></button>
            </header>
            <section class="modal-card-body">
                <label class="label">ID: {{ form.id }}</label>

                <label class="label">{{ lang.nameLabel }}</label>
                <p class="control">
                    <input ref="editName"
                           class="input"
                           type="text"
                           :placeholder="lang.namePlaceholder"
                           v-model="form.name"
                    >
                </p>
                <label class="label">{{ lang.descriptionLabel }}</label>
                <p class="control">
                    <textarea
                            class="textarea"
                            :placeholder="lang.descriptionPlaceholder"
                            v-model="form.description">
                    </textarea>
                </p>
                <p class="control">
                    <label class="checkbox">
                        <input type="checkbox" v-model="form.private">
                        {{ lang.privateLabel }}
                    </label>
                </p>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-success" @click="save">{{ lang.saveLabel }}</a>
                <a class="button" @click="close">{{ lang.cancelLabel }}</a>
                <a class="button is-warning" @click="hide">{{ lang.hideListLabel }}</a>
                <a class="button is-danger" @click="destroy">{{ lang.destroyLabel }}</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let self = this;
        },
        created() {
            let self = this;
            window.eventBus.$on('list-edit', function (listId) {
                self.edit(listId);
            });
        },
        data() {
            return {
                moduleClass: 'modal',
                form: {
                    id: 0,
                    name: '',
                    description: '',
                    private: false,
                    posts: []
                },
                lang: listig.lang,
            }
        },
        methods: {
            edit(listId) {
                let self = this;

                self.clearForm();

                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.get(`${listig.restUrl}/listing/${listId}`)
                    .then(function (response) {

                        if(response.data) {
                            self.form.id = response.data.id;
                            self.form.name = response.data.name;
                            self.form.description = response.data.description;
                            self.form.private = response.data.private;
                            self.form.posts = response.data.posts;
                        }

                        self.moduleClass = 'modal is-active';
                        setTimeout(function () {
                            self.$refs.editName.focus();
                        }, 500);
                    });
            },
            close() {
                let self = this;

                self.moduleClass = 'modal';
            },
            hide() {
                let self = this;
                self.close();
            },
            save() {
                let self = this;
                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.post(listig.restUrl + '/listing/' + self.form.id, self.form)
                    .then(function (response) {
                        self.close();
                        self.clearForm();
                        window.eventBus.$emit('list-rebound', response.data.id);
                    });
            },
            destroy() {
                let self = this;

                axios.defaults.headers.common['X-WP-Nonce'] = listig.nonce;
                axios.delete(listig.restUrl + '/listing/' + self.form.id)
                    .then(function (response) {
                        self.close();
                        window.eventBus.$emit('list-hide', self.form.id);
                        window.eventBus.$emit('list-rebound', self.form.id);
                    });
            },
            clearForm() {
                let self = this;

                self.form.id = 0;
                self.form.name = '';
                self.form.description = '';
                self.form.private = false;
                self.form.posts = [];
            }
        }
    };
</script>

<style>
</style>