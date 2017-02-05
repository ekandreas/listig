<template>
        <nav class="panel">
            <p class="panel-heading">
                {{ list.name }}
                <a class="icon pull-right gear-icon" @click="edit(list)">
                    <i class="fa fa-gear"></i>
                </a>
            </p>
            <a class="panel-block">
                { Drag your post here! }
            </a>
            <div class="panel-block">
                <div class="control">
                    <button class="button is-primary is-outlined is-fullwidth">Save</button>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    module.exports = {
        props: ['list'],
        data: function () {
            return {
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
            }
        }
    };
</script>

<style>
    .gear-icon {
        color: #999;
    }
</style>