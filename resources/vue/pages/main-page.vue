<template>
    <div class="page-frame">

        <top-menu></top-menu>

        &nbsp;<br/>

        <div class="columns">

            <div class="column">
                <post-search></post-search>
            </div>

            <div class="column">
                <listings></listings>
            </div>

            <div class="column">
                <post-preview></post-preview>
                <post-edit></post-edit>
            </div>

        </div>

        <list-edit ref="listEdit"></list-edit>

    </div>
</template>

<script>
    module.exports = {
        component: ListigTopMenu,
        props: ['title'],
        components: {
            'listEdit': ListigListEdit
        }
    };
</script>

<style>
    .page-frame {
        margin-right: 20px;
    }
</style>