<template>
<div class="page-frame">

        <top-menu :links="links"
                  showNewList="false"
                :title="title"></top-menu>

        &nbsp;<br/>

    </div>
</template>

<script>
    module.exports = {
        data() {
            return {
                title: 'Listig - ' + listig.lang.helpTitle,
                links: [
                    { title: 'Lists', url: '?page=listig/main'},
                    { title: 'Settings', url: '?page=listig/settings'}
                ]
            }
        }
    };
</script>

<style>
    .page-frame {
        margin-right: 20px;
    }
</style>