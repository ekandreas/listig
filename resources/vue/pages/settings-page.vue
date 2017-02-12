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
                links: [
                    { title: 'Lists', url: '?page=listig/main'},
                    { title: 'Help', url: '?page=listig/help'}
                ],
                title: 'Listig - ' + listig.lang.settingsTitle
            }
        }
    };
</script>

<style>
    .page-frame {
        margin-right: 20px;
    }
</style>