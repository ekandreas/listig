<template>

        <nav class="nav has-shadow top-menu">

            <div class="nav-left">
                <a class="nav-item">
                    <i class="fa fa-list-ul"></i>&nbsp;{{ title }}
                </a>
            </div>

            <div class="nav-center">
                <div class="nav-item" v-if="showNewList=='true'">
                    <a class="button is-primary" @click="newList">
                    <span class="icon is-small new-icon">
                        <i class="fa fa-plus"></i>
                    </span>
                        &nbsp;{{ lang.newListLabel }}
                    </a>
                </div>
            </div>

            <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
            <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
            <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>

            <!-- This "nav-menu" is hidden on mobile -->
            <!-- Add the modifier "is-active" to display it on mobile -->
            <div class="nav-right nav-menu">
                <a v-for="link in links" class="nav-item" :href="link.url">
                    {{ link.title }}
                </a>
            </div>

        </nav>

</template>

<script>
    module.exports = {
        props: ['title','showNewList','links'],
        data: function() {
            return {
                lang: listig.lang
            }
        },
        methods: {
            newList: function() {
                let self = this;

                window.eventBus.$emit('list-edit', 0);
            }
        }
    };
</script>

<style>
    .new-icon {
        margin-top: 6px;
    }

    .top-menu {
        background-color: whitesmoke;
    }
</style>