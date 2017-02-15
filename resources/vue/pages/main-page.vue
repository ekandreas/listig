<template>
    <div class="page-frame">

        <top-menu :links="links"
                  showNewList="true"
                  :title="title"></top-menu>

        &nbsp;<br/>

        <div class="columns">

            <div class="column is-3">
                <post-search></post-search>
            </div>

            <div class="column is-3">
                <listings></listings>
            </div>

            <div class="column is-6">
                <post-edit></post-edit>
            </div>

        </div>

        <list-edit ref="listEdit"></list-edit>

    </div>
</template>

<script>
    module.exports = {
        data() {
            return {
                links: [
                    //{ title: 'Help', url: '?page=listig/help'},
                    //{ title: 'Settings', url: '?page=listig/settings'}
                ],
                title: 'Listig'
            }
        }
    };
</script>

<style>
    .page-frame {
        margin-right: 20px;
    }
</style>